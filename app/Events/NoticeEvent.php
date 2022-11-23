<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NoticeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $userInfo;

    public function __construct($message, $userInfo)
    {
        $this->message = $message;
        $this->userInfo = $userInfo;
    }

    public function broadcastOn()
    {
        return ['aungmyin_' . $this->userInfo];
    }

    public function broadcastAs()
    {
        return 'notice';
    }
}