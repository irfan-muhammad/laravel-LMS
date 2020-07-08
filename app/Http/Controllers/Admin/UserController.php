<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{

    public function index(){
        $data = User::orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.index', compact('data'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * User display
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        $data = ([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'username' => $request->post('username'),
            ]);
        Mail::send('emails.welcome', $data, function ($message) {
            $message->from('irfan@example.com', 'Laravel');

            $message->to('info@example.com')->cc('bar@example.com');
        });

        // Mail::send('emails.welcome', $data, function ($message) use ($data) {
        //     $message->to($data['email'], $data['name'])
        //         ->subject('Welcome to LMS')
        //         ->from('info@example.com', 'Irfan');
        // });

       // Mail::to($request->post('email'))->send(new WelcomeEmail($data));


        $user->assignRole($request->input('roles'));

        return redirect()->route('admin.users.index')
                        ->with('success','User created successfully');
    }

    /**
     * User display
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }

    /**
     *
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update user data
     *
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('admin.users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove User
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')
                        ->with('success','User deleted successfully');
    }
}
