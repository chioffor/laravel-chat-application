<?php

namespace App\Listeners;

use App\Events\UserJoinedGroup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyGroupMembers
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
     * @param  UserJoinedGroup  $event
     * @return void
     */
    public function handle(UserJoinedGroup $event)
    {
        //
    }
}
