<?php

namespace App\Models;

use Cmgmyr\Messenger\Models\Models;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Class Message
 * @package App\Models
 */
class Thread extends \Cmgmyr\Messenger\Models\Thread
{
    protected $appends = ['unreadMessageForAuthUser'];
    /**
     * @return int
     */

    public function getUnreadMessageForAuthUserAttribute()
    {
        return $this->userUnreadMessagesCount(Auth::id());
    }

    /**
     * Messages relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * @codeCoverageIgnore
     */
    public function messagesLatest()
    {
        return $this->hasMany(Models::classname(\Cmgmyr\Messenger\Models\Message::class), 'thread_id', 'id')
            ->latest();
    }
}
