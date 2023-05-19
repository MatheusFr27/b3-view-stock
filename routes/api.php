<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\HistoryActionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'action'], function () {
    Route::get('initialize', [ActionController::class, 'initialize']);
});

Route::group(['prefix' => 'history-action'], function () {
    Route::get('find-by-action-id/{action_id}', [HistoryActionController::class, 'findByActionId']);
});
