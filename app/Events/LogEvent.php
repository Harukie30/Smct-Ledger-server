<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
// use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct
    (
        public int $authID,
        public string $fileName,
        public string $info,
        public string $created_at,
    )
    {
        //
    }

    // name ni cya sa .listen sa fornt end laravel echo subcribe
    public function broadcastAs(): string
    {
        return 'log.created';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('logs.'.$this->authID),
        ];
    }

    // data nga i pass to the websocket
    public function broadcastWith(): array
    {
        return [
            'file_name'     => $this->fileName,
            'info'          => $this->info,
            'created_at'    => $this->created_at,
        ];
    }
}
