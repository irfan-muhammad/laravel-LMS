<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\TopicContract;
use App\Contracts\LessonContract;

class CourseTopicsLessonController extends Controller
{
    /**
     * @var TopicContract
     */
    protected $lessonRepository;
    /**
     * @var LessonContract
     */
    protected $topicRepository;


    /**
     * CategoryController constructor.
     * @param CategoryContract $courseRepository
     */
    public function __construct(TopicContract $topicRepository, LessonContract $lessonRepository)
    {

        $this->topicRepository = $topicRepository;
        $this->lessonRepository = $lessonRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {


        $targetTopic = $this->topicRepository->findTopicById($id);
        $lessons = $this->lessonRepository->findLessonsById($id);



        $this->setPageTitle('Course Lessons', 'List of all Course Topics Lessons');
        return view('admin.lessons.index', compact('lessons', 'targetTopic'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id)
    {

        $targetTopic = $this->topicRepository->findTopicById($id);
        $topics = $this->topicRepository->treeList();

        $this->setPageTitle('Course Lesson', 'Create Course Topic');
        return view('admin.lessons.create', compact('topics', 'targetTopic'));

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
            'topic_id' =>  'required|not_in:0',
        ]);

        $params = $request->except('_token');

        $topic_id = $params['topic_id'];

        $lesson = $this->lessonRepository->createLesson($params);

        if (!$lesson) {
            return $this->responseRedirectBack('Error occurred while creating Lesson.', 'error', true, true);
        }
        return $this->responseRedirect('admin.lessons.index', 'Lesson added successfully' ,'success',false, false, $topic_id);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $lesson = $this->lessonRepository->findLessonById($id);
        $topics = $this->topicRepository->treeList();

            // foreach($courses as $category){
            //     echo '<pre>';
            //     print_r($category->childs[0]->name);
            //     echo '</pre>';
            // }

        $this->setPageTitle('Lesson', 'Edit Lesson : '.$lesson->title);
        return view('admin.lessons.edit', compact('topics', 'lesson'));
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
            'topic_id' =>  'required|not_in:0',
            //'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $topic = $this->lessonRepository->updateLesson($params);

        if (!$topic) {
            return $this->responseRedirectBack('Error occurred while updating Lesson.', 'error', true, true);
        }
        return $this->responseRedirectBack('Lesson updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $topic = $this->topic->deleteLesson($id);

        if (!$topic) {
            return $this->responseRedirectBack('Error occurred while deleting Course.', 'error', true, true);
        }
        return $this->responseRedirect('admin.lessons.index', 'Category deleted successfully' ,'success',false, false);
    }
}
