<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Courses;
use App\User;
use App\Mail\SendCoursesMail;
use Illuminate\Support\Facades\Mail;


class CoursesHourlyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'courses:hourlyupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Courses new listings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $courses = Courses::where('active', true)->get();
        //print_r($courses);
       // $courses->where('created_at', '>=', date('Y-m-d').' 00:00:00');
       // $courses->whereDate('created_at', '=', date('Y-m-d'));
        // $course_listings = 'here are new listings';
        // foreach($courses as $course){
        //     $course_listings .= '<strong>'.$course->title.'</strong><b/>';
        // }

        $users = User::all();
        foreach ($users as $user) {

            // Mail::raw($course_listings, function ($mail) use ($user) {
            //     $mail->from('mi20@gmail.com');
            //     $mail->to($user->email)
            //         ->subject('Courses of the Day');
            // });

            Mail::to($user->email)->send(new SendCoursesMail($courses));

        }
        $this->info('Today Course Listings sent to All Users');


    }
}
