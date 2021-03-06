<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\myMusicController;
use App\Http\Controllers\loginController;
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

Route::get('/', [myMusicController::class, 'index']);
Route::get('/songs', [myMusicController::class, 'showSongsPage']);
Route::get('/events', [myMusicController::class, 'showEventsPage']);
Route::get('/songDetail', [myMusicController::class, 'getSongLyrics']);

Route::get('/loginSpotify', [loginController::class, 'loginSpotify']);
Route::get('/loggedin', [loginController::class, 'loggedin']);
Route::get('/redirectAuthorize', [loginController::class, 'redirectAuthorize']);