<?php

namespace App\Listeners;

use App\Events\ReadChatMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ResetChatCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReadChatMessage  $event
     * @return void
     */
    public function handle(ReadChatMessage $event)
    {
        //
    }
}
