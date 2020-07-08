<?php

namespace App\Repositories;

use App\Models\Lessons;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\LessonContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Str;

/**
 * Class LessonRepository
 *
 * @package \App\Repositories
 */
class LessonRepository extends BaseRepository implements LessonContract
{
    use UploadAble;

    /**
     * LessonRepository constructor.
     * @param Course $model
     */
    public function __construct(Lessons $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listLessons(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

     /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findLessonsById(int $id)
    {
        try {
           // $data = array('id'=>$id);
            return $this->findallBy($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }
    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findLessonById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }

    }

    /**
     * @param array $params
     * @return Course|mixed
     */
    public function createLesson(array $params)
    {
        try {
            $collection = collect($params);

            $slug = Str::slug($params['title']);

            $image = null;

            if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {
                $image = $this->uploadOne($params['image'], 'courses');
            }


            $active = $collection->has('active') ? 1 : 1;

            $merge = $collection->merge(compact('slug', 'image', 'active'));

            $lesson= new Lessons($merge->all());


            // print_r($Course);
            // exit;


            $lesson->save();

            return $lesson;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateLesson(array $params)
    {
        $Course = $this->findLessonById($params['id']);

        $collection = collect($params)->except('_token');

        $featured = $collection->has('featured') ? 1 : 0;
        $menu = $collection->has('menu') ? 1 : 0;


        //print_r($params);
        //exit;


        if ($collection->has('image') && ($params['image'] instanceof  UploadedFile)) {

            if ($Course->image != null) {
                $this->deleteOne($Course->image);
            }

            $image = $this->uploadOne($params['image'], 'courses');
            $merge = $collection->merge(compact('menu', 'image', 'featured'));
        } else {
            $merge = $collection->merge(compact('menu', 'featured'));
        }

        $Course->update($merge->all());

        return $Course;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteLesson($id)
    {
        $Course = $this->findLessonById($id);

        if ($Course->image != null) {
            $this->deleteOne($Course->image);
        }

        $Course->delete();

        return $Course;
    }

    /**
     * @return mixed
     */
    public function treeList()
    {

        return $courses = Lessons::get();
        //return $Courses = Course::get();

    }

    public function findBySlug($slug)
    {
        return Lessons::with('lessons')
            ->where('slug', $slug)
            ->where('menu', 1)
            ->first();
    }
}
