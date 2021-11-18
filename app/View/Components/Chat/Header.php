<?php

namespace App\View\Components\Chat;

use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $user;
    public $group;
    public $groups;
    public $otherGroups;

    public function __construct($user, $group, $groups, $otherGroups)
    {
        $this->user = $user;
        $this->group = $group;
        $this->groups = $groups;
        $this->otherGroups = $otherGroups;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.chat.header');
    }
}
