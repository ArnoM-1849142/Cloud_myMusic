<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\myMusicController;
use App\Models\Playlist;

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

Route::resource('/', myMusicController::class);
Route::get('/loginSpotify', [myMusicController::class, 'loginSpotify']);
Route::get('/redirectAuthorize', [myMusicController::class, 'redirectAuthorize']);