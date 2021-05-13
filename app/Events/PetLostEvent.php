<?php

namespace App\Events;

use App\Models\Accident;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class PetLostEvent
 *
 * @package App\Events
 */
class PetLostEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Accident
     */
    private $accident;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Accident $accident)
    {
        $this->accident = $accident;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('lost');
    }

    /**
     * Get the data to broadcast.
     *
     * @author Author
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->accident->id,
            'accident' => $this->accident,

        ];
    }
}
