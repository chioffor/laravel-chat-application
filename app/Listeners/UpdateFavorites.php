<?php

namespace App\Listeners;

use App\Events\ClickedFavorite;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateFavorites
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
     * @param  ClickedFavorite  $event
     * @return void
     */
    public function handle(ClickedFavorite $event)
    {
        //
    }
}
