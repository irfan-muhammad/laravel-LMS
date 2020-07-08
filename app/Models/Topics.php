<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topics extends Model
{
     /**
     * @var string
     */
    protected $table = 'course_topics';

    /**
     * @var array
     */
    protected $fillable = [
        'course_id', 'author_id', 'title', 'slug', 'body', 'active'
    ];

    /**
     * @var array
     */
    protected $casts = [

        'active'  =>  'boolean'
    ];

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function coursestitle() {

        return $this->belongsTo('App\Models\Courses', 'course_id');
    }

    public function author() {

        return $this->belongsTo('App\User', 'author_id');
    }

    public function lessons() {
        return $this->hasMany('App\Models\Lessons');
    }

}
