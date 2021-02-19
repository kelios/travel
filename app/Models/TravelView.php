<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TravelView
 * @package App\Models
 */
class TravelView extends Model
{
    /**
     * @var string
     */
    protected $table = 'travel_views';

    /**
     * @var array
     */
    protected $fillable = [
        'travel_id',
        'user_id',
        'titleslug',
        'url',
        'session_id',
        'user_id',
        'ip',
        'agent'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function travels()
    {
        return $this->belongsTo(Travel::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(\App\User::class);
    }
}
