<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CourseTopics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author_id')->nullable(); //changed this line
            $table->foreign('author_id')->references('id') ->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('course_id')->nullable(); //changed this line
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->string('title')->unique();
            $table->text('body');
            $table->string('slug')->unique();
            $table->boolean('active')->default('0');
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
        Schema::dropIfExists('course_topics');
    }
}
