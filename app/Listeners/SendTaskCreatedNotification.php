<?php

namespace App\Listeners;
use App\Events\TaskCreated;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTaskCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->events = $id;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TaskCreated $event)
    {
        return response()->json('Task Created successfully.'    );
    }
}
