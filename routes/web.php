<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupChatController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/main');
    } else {        
        return view('entry');
    } 
})->name('login');

Route::post('/entry', [UserController::class, 'store']);

Route::get('/main', [GroupController::class, 'show'])->middleware('auth')->name('main');

Route::post('/main', [GroupChatController::class, 'store']);
