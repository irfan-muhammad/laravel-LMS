<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Courses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author_id')->nullable(); //changed this line
            $table->foreign('author_id')->references('id') ->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable(); //changed this line
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('title')->unique();
            $table->text('body');
            $table->string('slug')->unique();
            $table->string('duration');
            $table->string('credits');
            $table->string('lectures');
            $table->string('classdays');
            $table->string('classtiming');
            $table->string('seatsavailabity');
            $table->string('image')->nullable();
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('courses');

    }
}
