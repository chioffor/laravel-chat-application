<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupChatController;
use App\Http\Controllers\UserController;


Route::get('/', function() {
    return;
});

Route::get('/chatapp', function () {
    if (Auth::check()) {
        return redirect('/chatapp/main');
    } else {        
        return view('entry');
    } 
})->name('login');

Route::post('/chatapp/entry', [UserController::class, 'store']);

Route::get('/chatapp/main', [GroupController::class, 'show'])->middleware('auth');

Route::post('/chatapp/main', [GroupChatController::class, 'store']);
