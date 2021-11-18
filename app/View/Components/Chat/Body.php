<?php

namespace App\View\Components\Chat;

use Illuminate\View\Component;

class Body extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user;
    public $chats;
    public $newUser;

    public function __construct($user, $chats, $newUser)
    {
        $this->user = $user;
        $this->chats = $chats;
        $this->newUser = $newUser;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.chat.body');
    }
}
