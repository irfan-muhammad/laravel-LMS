<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Courses extends Model
{
     /**
     * @var string
     */
    protected $table = 'courses';

    /**
     * @var array
     */
    protected $fillable = [
        'category_id', 'author_id', 'title', 'slug', 'body', 'duration', 'credits', 'lectures', 'classdays', 'classtiming', 'seatsavailabity', 'image'
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

    public function category() {

        return $this->belongsTo('App\Models\Category');
    }

    public function topics() {
        return $this->hasMany('App\Models\Topics');
    }
}
