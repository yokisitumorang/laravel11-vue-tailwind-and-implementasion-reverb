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
use Log;
use App\Models\User;


class UpdateData implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $info;
    /**
     * Create a new event instance.
     */
    public function __construct($info)
    {
        $this->info  = $info;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        Log::debug("message");
        return [
            new Channel('dashboard'),
            
        ];
    }

    public function broadcastAs(): string
    {
        return 'data.updated';
    }

    public function broadcastWith(): array
    {
        $data = User::count();
        $testdata = User::count();

        $arrayData=[];
        $arrayData2=[];

        for ($i = 0; $i < 9; $i++) {

            $randomNumber = rand(0, 100);
            $randomNumber2 = rand(0, 100);
            Log::debug($randomNumber);

            array_push($arrayData,$randomNumber);
            array_push($arrayData2,$randomNumber2);
            // $arrayData[] = $testdata + $i;
        }
        // return $data;
        return ['data' => $data ,'array_data'=>$arrayData,'array_data2'=>$arrayData2];
    }
}
