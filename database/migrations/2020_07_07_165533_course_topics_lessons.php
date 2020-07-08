<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourseTopicsLessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_topics_lessons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author_id')->nullable(); //changed this line
            $table->foreign('author_id')->references('id') ->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('topic_id')->nullable(); //changed this line
            $table->foreign('topic_id')->references('id')->on('course_topics')->onDelete('cascade');
            $table->string('title')->unique();
            $table->text('body');
            $table->string('slug')->unique();
            $table->string('videourl')->nullable();
            $table->boolean('active')->default('0')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_topics_lessons');
    }
}
