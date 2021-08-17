<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Chat;
use App\Events\ChatSent;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = request()->user();
        $id = request()->input('groupID');
        $message = request()->input('message');
        $url = request()->input('url');

        $group = Group::find($id);
    
        $chat = new Chat;
        $chat->chat = $message;
        $group->chats()->save($chat);
        $user->chats()->save($chat);

        foreach ($group->users as $subuser) {
            if ($subuser === $user) {
                foreach ($user->groups as $subgroup) {
                    if ($subgroup->id != $group->id)
                }
                $i = $user->groups.indexOf($group)
                $g = $user->$group;
                $g->pivot->unreadCount = 0;
                $g->pivot->save();
            } else {
                $userGroup = $subuser->groups->find($id);
                $userGroup->pivot->unreadCount++;
                $userGroup->pivot->save();
            }
        }

        // $userGroup = $user->groups->find($id);
        // $userGroup->pivot->unreadCount++;
        // $userGroup->pivot->save();
        
        $data = [
            'username' => $user->name,
            'message' => $chat->chat,
            'time' => $chat->getTime(),
            'url' => [
                'group' => $url,
                'home' => url('/home'),
            ],
            'id' => $id,
        ];
    
        event(new ChatSent($data));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
