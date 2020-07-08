<?php

namespace App\Contracts;

/**
 * Interface LessonContract
 * @package App\Contracts
 */
interface LessonContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listLessons(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findLessonById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createLesson(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateLesson(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteLesson($id);

    /**
     * @return mixed
     */
    public function treeList();

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug);
}
