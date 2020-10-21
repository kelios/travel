<?php

namespace App\Models;

use Cmgmyr\Messenger\Models\Models;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Message
 * @package App\Models
 */
class Thread extends \Cmgmyr\Messenger\Models\Thread
{
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
