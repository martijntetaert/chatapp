<?php
namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class MessagePushed implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    private $message;
    private $username;
// 2
    public function __construct($message, $username)
    {
        $this->message = $message;
        $this->username = $username;
    }
// 3
    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'username' => $this->username,
        ];
    }
// 4
    public function broadcastAs()
    {
        return 'send';
    }
// 5
    public function broadcastOn()
    {
        return new channel('chat');
    }
}
