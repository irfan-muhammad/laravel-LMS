<?php

namespace App\Repositories;

use App\Models\Topics;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\TopicContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Support\Str;

/**
 * Class TopicRepository
 *
 * @package \App\Repositories
 */
class TopicRepository extends BaseRepository implements TopicContract
{
    use UploadAble;

    /**
     * CoursesRepository constructor.
     * @param Course $model
     */
    public function __construct(Topics $model)
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
    public function listTopics(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findTopicById(int $id)
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
    public function createTopic(array $params)
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

            $Course = new Topics($merge->all());


            // print_r($Course);
            // exit;


            $Course->save();

            return $Course;

        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateTopic(array $params)
    {
        $Course = $this->findTopicById($params['id']);

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
    public function deleteTopic($id)
    {
        $Course = $this->findTopicById($id);

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

        return $courses = Topics::get();
        //return $Courses = Course::get();

    }

    public function findBySlug($slug)
    {
        return Topics::with('lessons')
            ->where('slug', $slug)
            ->where('menu', 1)
            ->first();
    }
}
