<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

    protected $fillable = [
        'name',
        'description',
        'article_type_id',
        'publish',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/articles/' . $this->getKey());
    }

    public function articleType()
    {
        return $this->belongsTo(ArticleType::class);
    }
}
