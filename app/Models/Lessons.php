<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lessons extends Model
{
     /**
     * @var string
     */
    protected $table = 'course_topics_lessons';

    /**
     * @var array
     */
    protected $fillable = [
        'topic_id', 'author_id', 'title', 'slug', 'body', 'videourl', 'active'
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

    public function topictitle() {

        return $this->belongsTo('App\Models\Topics', 'topic_id');
    }

    public function author() {

        return $this->belongsTo('App\User', 'author_id');
    }
}
