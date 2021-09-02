<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DirectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserChatController;

use App\Models\Chat;
use App\Models\Group;
use App\Models\User;
use App\Models\Direct;

use App\Events\ChatSent;
use App\Events\ReadChatMessage;
use App\Events\ClickedFavorite;


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

Route::get('/home/group/{id}', [GroupController::class, 'show'])
    ->middleware('auth')
    ->name('group-page');

Route::get('/home/join/{groupID}', [GroupUserController::class, 'edit'])
    ->middleware('auth')
    ->name('join-group');

Route::get('/home/leave/{groupID}', [GroupUserController::class, 'edit'])
    ->middleware('auth')
    ->name('leave-group');

Route::post('/group/chat/{groupID}', [ChatController::class, 'store']);
Route::post('chat-message', [ChatController::class, 'store']);
Route::get('/favorite/{groupID}', [GroupUserController::class, 'update'])
    ->name('favorite');    
Route::get('/home/direct/{id}', [DirectController::class, 'store']);
Route::get('/home/private/{id}', [DirectController::class, 'show'])
    ->middleware('auth')
    ->name('private-page');
Route::post('/home/private/{id}', [ChatController::class, 'store']);
Route::post('/home/group/{id}', [ChatController::class, 'store']);
Route::get('/updateChatsCount/{id}', [UserChatController::class, 'update']);    

Route::get("/goHome", function () {
    return redirect()->route('home');
});