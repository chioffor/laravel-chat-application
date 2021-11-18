<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Models\Chat;
use App\Models\Group;
use App\Models\User;
use App\Events\ChatSent;
use App\Events\NewUserJoined;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/main');
    } else {        
        return view('entry');
    } 
})->name('login');

Route::post('/entry', [UserController::class, 'store']);    


Route::get('/main', function () { 
    $user = Auth::user();
    $main = Group::find(1);
    $welcome = null;

    if (!$main->users->containsStrict('id', $user->id)) {
        $main->users()->save($user);
        $welcome = true;
        $data = [
            "url" => url('/main'),
            "welcomeMessage" => $welcome,
            "new_user_name" => $user->name,
        ];
        
        event(new NewUserJoined($data));
    } else {
        $welcome = false;
    }


    return view('main', [
        "user" => $user, 
        "group" => Group::find(1), 
        "groups" => Group::all(),
        "otherGroups" => Group::all()->diff($user->groups),
        "welcome" => $welcome,      
    ]);    
})->middleware('auth')->name('main');

Route::post('/main', function () {
    $user = Auth::user();
    $id = request()->input('id');
    $group = Group::find($id);

    $chat = new Chat;
    $chat->chat = request()->input('message');

    $group->chats()->save($chat);
    $user->chats()->save($chat);

    $data = [
        "username" => $user->name,
        "message" => $chat->chat,
        "time" => $chat->getTime(),
        "url" => url()->current(),
        "userID" => $user->id,        
    ];

    event(new ChatSent($data));

});
