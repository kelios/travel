<?php

namespace App\Models;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App\Models
 */
class Message extends \Cmgmyr\Messenger\Models\Message
{
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/messages/'.$this->getKey());
    }
}
