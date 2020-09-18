<?php

namespace App\Events;

use App\Http\Resources\Travel;
use App\Http\Resources\TravelCollection;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class SearchEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $travels;
    public $where;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($travels, $where)
    {
        $this->travels = $travels;
        $this->where = $where;
    }

    public function broadcastAs()
    {
        return 'searchResults';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('search');
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'travels' => new TravelCollection($this->travels),
            'where' => $this->where
        ];
    }
}
