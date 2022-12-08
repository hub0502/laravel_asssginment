<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('get_user', 'get_user');
});

Route::controller(BoardController::class)->group(function(){
    Route::get('boards', 'index');
    Route::post('board', 'store');
    Route::get('board/{id}', 'show');
    Route::post('boards', 'shows');
    Route::put('board/{id}', 'update');
    Route::delete('board/{id}', 'destroy');
});

Route::controller(ChatController::class)->group(function(){
    Route::get('chats', 'index');
    Route::post('chat', 'store');
    Route::get('chat/{board_id}', 'show');
    // Route::put('board/{id}', 'update');
    Route::post('chat/{id}', 'destroy');
});