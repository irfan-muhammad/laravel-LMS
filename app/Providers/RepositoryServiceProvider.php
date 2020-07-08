<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\CategoryContract;
use App\Repositories\CategoryRepository;
use App\Contracts\CourseContract;
use App\Repositories\CourseRepository;
use App\Contracts\TopicContract;
use App\Repositories\TopicRepository;
use App\Contracts\LessonContract;
use App\Repositories\LessonRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $repositories = [
        CategoryContract::class         =>          CategoryRepository::class,
        CourseContract::class        =>          CourseRepository::class,
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(CategoryContract::class, CategoryRepository::class);
        $this->app->bind(CourseContract::class, CourseRepository::class);
        $this->app->bind(TopicContract::class, TopicRepository::class);
        $this->app->bind(LessonContract::class, LessonRepository::class);



    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
