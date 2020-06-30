<?php

namespace App\Models;

use Carbon\Carbon;
use App\Collection\CommentCollection;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'comment',
        'users_id',
        'travel_id',
        'reply_id'
    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/comments/' . $this->getKey());
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d.m.Y');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_id')->with('user');
    }

    public function newCollection(array $models = [])
    {
        return new CommentCollection($models);
    }
}

