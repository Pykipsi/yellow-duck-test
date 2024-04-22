<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'bot'], function () {
    Route::group(['prefix' => 'telegram'], function () {
        Route::post('/get-action', [App\Http\Controllers\Telegram\BotController::class, 'getAction']);
    });
});

Route::group(['prefix' => 'trello'], function () {
    Route::match(['head', 'post'], '/get-action', [App\Http\Controllers\TrelloController::class, 'getAction']);
    //Route::get('/get-cards-from-board', [App\Http\Controllers\TrelloController::class, 'getCards']);
});
