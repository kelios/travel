<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    protected $table = 'article_type';

    protected $fillable = [
        'name',
        'status',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/article-types/'.$this->getKey());
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
