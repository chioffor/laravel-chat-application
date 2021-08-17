<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ChatController;
use App\Models\Chat;
use App\Models\Group;
use App\Models\User;

use App\Events\ChatSent;
use App\Events\UserJoinedGroup;
use App\Events\ReadChatMessage;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    } else {        
        return view('entry');
    } 
});

Route::post('/entry', function () {
    $user = new User;
    $user->name = request()->input('name');
    $user->password = uniqid("user", true);
    $user->save();
    Auth::login($user);
    return redirect('/home');
});

Route::get('/home', function () {    
    return view('home', ["user" => Auth::user(), "groups" => Group::all()]);    
});

Route::post('/create-group', [GroupController::class, 'store']);

Route::get('/home/{id}', function($id) {
    $group = Group::find($id);

    $data = [
        'url' => url('/home'),
        'id' => $id,
    ];
    //event(new ReadChatMessage($data));
    return view('group', ['group' => $group, 'user' => request()->user()]);
});

Route::get('/home/join/{groupID}', function ($groupID) {
    if (!Auth::check())
        return redirect('/');

    $user = request()->user();    
    $group = Group::find($groupID);
    $user->groups()->save($group);

    $url = url("/home/{$groupID}");
    $username = $user->name;
    $data = [
        'url' => $url,
        'username' => $username,
    ];

    event(new UserJoinedGroup($data));

    return redirect(url('/home/'.$group->id));
});


Route::post('/group/chat/{groupID}', [ChatController::class, 'store']);

Route::get('event', function () {
    echo url()->current();
});

Route::get('listen', function () {
    return view('listenBroadcast');
});

Route::post('chat-message', [ChatController::class, 'store']);

