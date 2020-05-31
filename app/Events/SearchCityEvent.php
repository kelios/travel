<?php

namespace App\Events;

//use App\Http\Resources\CityCollection;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class SearchCityEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cities;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($cities)
    {
        $this->cities = $cities;
    }

    public function broadcastAs()
    {
        return 'searchResultsCity';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('searchCity');
    }

    /**
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'cities' => $this->cities,
        ];
    }
}
