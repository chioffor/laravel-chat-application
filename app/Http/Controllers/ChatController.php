<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Chat;
use App\Models\Direct;
use App\Events\ChatSent;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getGroup($id)
    {
        return Group::find($id);
    }

    public function getDirect($id)
    {
        return Direct::find($id);
    }

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

    public function store(Request $request, $id)
    {
        $user = $request->user();
        $chat = new Chat;
        $url = url()->current();
        $model = null;
        $chatType = null;

        if ($url == url('/home/group/'.$id)) {
            $model = $this->getGroup($id);
            $chatType = 'group';
        } else if ($url == url('/home/private/'.$id)) {
            $model = $this->getDirect($id);
            $chatType = 'direct';
        }

        $userID = $request->input('userID');
        $message = $request->input('message');
        $chat->chat = $message;

        $model->chats()->save($chat);
        $user->chats()->save($chat);

        $data = [
            "username" => $user->name,
            "message" => $chat->chat,
            "time" => $chat->getTime(),
            "id" => $id,
            "userID" => $userID,
            "chatType" => $chatType,
            "url" => [
                "group" => $url,
                "home" => url('/home'),
            ],            
        ];

        event(new ChatSent($data));

    }
    // public function store(Request $request)
    // {
    //     $user = request()->user();
    //     $id = request()->input('groupID');
    //     $message = request()->input('message');
    //     $url = request()->input('url');

    //     $group = Group::find($id);
    
    //     $chat = new Chat;
    //     $chat->chat = $message;
    //     $group->chats()->save($chat);
    //     $user->chats()->save($chat);

    //     for ($i=0; $i < $group->users->count(); $i++) {
    //         if ($group->users[$i]->id !==$user->id ) {
    //             for ($j=0; $j < $group->users[$i]->groups->count(); $j++) {
    //                 $g = $group->users[$i]->groups[$j];
    //                 $g->pivot->unreadCount++;
    //                 $g->pivot->save();
    //             }
    //         } 
    //     }

    //     $data = [
    //         'username' => $user->name,
    //         'message' => $chat->chat,
    //         'time' => $chat->getTime(),
    //         'url' => [
    //             'group' => $url,
    //             'home' => url('/home'),
    //         ],
    //         'id' => $id,
    //     ];
    
    //     event(new ChatSent($data));
    // }

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
