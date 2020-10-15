<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App\Models
 */
class Message extends Model
{
    protected $fillable = [
        'messages',
        'travel_id',
        'sender_id',
        'recipient_id',
        'is_read',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/messages/' . $this->getKey());
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id')->with('user');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id')->with('user');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('d.m.Y');
    }

}
