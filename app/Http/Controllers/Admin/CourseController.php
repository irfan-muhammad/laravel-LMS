<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\CourseContract;
use App\Contracts\CategoryContract;


class CourseController extends Controller
{
    /**
     * @var CourseContract
     */
    protected $courseRepository;
    /**
     * @var CategoryContract
     */
    protected $categoryRepository;


    /**
     * CategoryController constructor.
     * @param CategoryContract $courseRepository
     */
    public function __construct(CourseContract $courseRepository, CategoryContract $categoryRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $courses = $this->courseRepository->treeList();

        $this->setPageTitle('Courses', 'List of all Courses');
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $courses = $this->courseRepository->treeList();


        $courses = $this->courseRepository->listCourses();
        $categories = $this->categoryRepository->listCategories();
        $this->setPageTitle('Courses', 'Create Course');
        return view('admin.courses.create', compact('categories'));

        // $data = User::orderBy('id', 'DESC')->paginate(10);
        // return view('admin.users.index', compact('data'));


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            //'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $category = $this->courseRepository->createCourse($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while creating Course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.courses.index', 'Course added successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetCourse = $this->courseRepository->findCourseById($id);
        $categories = $this->categoryRepository->treeList();

            // foreach($courses as $category){
            //     echo '<pre>';
            //     print_r($category->childs[0]->name);
            //     echo '</pre>';
            // }

        $this->setPageTitle('Courses', 'Edit Course : '.$targetCourse->name);
        return view('admin.courses.edit', compact('categories', 'targetCourse'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'      =>  'required|max:191',
            'category_id' =>  'required|not_in:0',
            //'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $category = $this->courseRepository->updateCourse($params);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while updating Course.', 'error', true, true);
        }
        return $this->responseRedirectBack('Course updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $category = $this->courseRepository->deleteCourse($id);

        if (!$category) {
            return $this->responseRedirectBack('Error occurred while deleting Course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.courses.index', 'Category deleted successfully' ,'success',false, false);
    }
}
