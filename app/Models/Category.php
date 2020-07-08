<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', 'featured', 'menu', 'image'
    ];

    /**
     * @var array
     */
    protected $casts = [
       // 'parent_id' =>  'integer',
        'featured'  =>  'boolean',
        'menu'      =>  'boolean'
    ];

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // public function categories()
    // {
    //     return $this->hasMany(Category::class);
    // }

    // public function childrenCategories()
    // {
    //     return $this->hasMany(Category::class)->with('categories');
    // }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childs() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function course() {
        return $this->hasMany('App\Models\Courses');
    }


}
