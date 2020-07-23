<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TravelLike
 * @package App\Models
 */
class TravelSave extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'travel_save';

    /**
     * @var array
     */
    protected $fillable = [
        'travel_id',
        'user_id',
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
