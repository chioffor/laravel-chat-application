<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MemberController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DirectController;
use App\Http\Controllers\UserController;
use App\Models\Chat;
use App\Models\Group;
use App\Models\User;
use App\Models\Direct;

use App\Events\ChatSent;
use App\Events\UserJoinedGroup;
use App\Events\ReadChatMessage;
use App\Events\ClickedFavorite;

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
})->name('login');

Route::post('/entry', [UserController::class, 'store']);    

Route::get('/home', function () { 
    $user = request()->user();   
    return view('home', [
        "user" => Auth::user(), 
        "groups" => Group::all(),
        "directs" => $user->directs,
    ]);    
})->middleware('auth')->name('home');

Route::post('/create-group', [GroupController::class, 'store']);

Route::get('/home/{id}', function($id) {
    $group = Group::find($id);

    $data = [
        'url' => url('/home'),
        'id' => $id,
    ];

    $user = request()->user();
    $g = $user->groups->firstWhere('id', '=', $group->id);
    $g->pivot->unreadCount = 0;
    $g->pivot->save();
    return view('group', [
        'group' => $group, 
        'user' => request()->user(),
        'userID' => $user->id,
    ]);
})->middleware('auth');

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
})->middleware('auth');


Route::post('/group/chat/{groupID}', [ChatController::class, 'store']);
Route::post('chat-message', [ChatController::class, 'store']);
Route::post('/favorite', function () {
    $id = request()->input('id');
    $group = Group::find($id);
    $user = request()->user();

    $info = false;

    $g = $user->groups->firstWhere('id', '=', $id);
    if ($g->pivot->favorite == true) {
        $g->pivot->favorite = false;
        $g->pivot->save();
        $info = false;
    } else {
        $g->pivot->favorite = true;
        $g->pivot->save();
        $info = true;
    }

    $data = [
        'id' => $id,
        'info' => $info,
    ];
    event(new ClickedFavorite($data));
});

Route::get('/home/direct/{id}', [DirectController::class, 'store']);
Route::get('/home/private/{id}', [DirectController::class, 'index']);


Route::post('/home/private/{id}', [ChatController::class, 'store']);
Route::post('/home/{id}', [ChatController::class, 'store']);
Route::post('/updateChatsCount', function() {
    $user = request()->user();
    $id = request()->input('id');
    $url = request()->input('url');
    if ($url === url('/home/'.$id)) {
        $g = $user->groups->firstWhere('id', '=', $id);
        $g->pivot->unreadCount++;
        $g->pivot->save();
    } else if ($url === url('/home/private'.$id)) {
        $g = $user->directs->firstWhere('id', '=', $id);
        $g->pivot->unreadCount++;
        $g->pivot->save();

    }

});

Route::get("/goHome", function () {
    return redirect()->route('home');
});