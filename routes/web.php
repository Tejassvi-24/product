<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/welcome',function(){
//     echo "Welcome Tejassvi Arun";

// });
Route::resource('posts', PostController::class);