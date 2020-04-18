<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTravel extends Model
{
    protected $table = 'category_travel';

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
        return url('/admin/category-travels/'.$this->getKey());
    }
}
