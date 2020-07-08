<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\CourseContract;
use App\Contracts\TopicContract;

class CourseTopicsController extends Controller
{
    /**
     * @var CourseContract
     */
    protected $courseRepository;
    /**
     * @var CategoryContract
     */
    protected $topicRepository;


    /**
     * CategoryController constructor.
     * @param CategoryContract $courseRepository
     */
    public function __construct(TopicContract $topicRepository, CourseContract $courseRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->topicRepository = $topicRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $targetCourse = $this->courseRepository->findCourseById($id);
        $topics = $this->topicRepository->treeList();

        $this->setPageTitle('Course Topics', 'List of all Course Topics');
        return view('admin.topics.index', compact('topics', 'targetCourse'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id)
    {

        $targetCourse = $this->courseRepository->findCourseById($id);
        $courses = $this->courseRepository->listCourses();

        $this->setPageTitle('Course Topic', 'Create Course Topic');
        return view('admin.topics.create', compact('courses', 'targetCourse'));

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
            'course_id' =>  'required|not_in:0',
        ]);

        $params = $request->except('_token');

        $course_id = $params['course_id'];

        $topic = $this->topicRepository->createTopic($params);

        if (!$topic) {
            return $this->responseRedirectBack('Error occurred while creating Topic.', 'error', true, true);
        }
        return $this->responseRedirect('admin.topics.index', 'Course added successfully' ,'success',false, false, $course_id);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $targetTopic = $this->topicRepository->findTopicById($id);
        $courses = $this->courseRepository->treeList();

            // foreach($courses as $category){
            //     echo '<pre>';
            //     print_r($category->childs[0]->name);
            //     echo '</pre>';
            // }

        $this->setPageTitle('Topic', 'Edit Topic : '.$targetTopic->name);
        return view('admin.topics.edit', compact('courses', 'targetTopic'));
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
            'course_id' =>  'required|not_in:0',
            //'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $topic = $this->topicRepository->updateTopic($params);

        if (!$topic) {
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
        $topic = $this->topic->deleteCourse($id);

        if (!$topic) {
            return $this->responseRedirectBack('Error occurred while deleting Course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.topics.index', 'Category deleted successfully' ,'success',false, false);
    }
}
