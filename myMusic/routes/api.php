<?php

use App\Models\Song;
use App\Models\SoundSettings;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
Route::get("/soundsettings", [\App\Http\Controllers\SoundSettingsController::class,
                            "soundsettingZoekerService"]);
                        */

//Route::resource('/soundsettings', App\Http\Controllers\API\SoundSettingsController::class);
Route::get('/soundsettings', [App\Http\Controllers\API\SoundSettingsController::class, 'soundsettingZoekerService']);

Route::post('/soundsettings', [App\Http\Controllers\API\SoundSettingsController::class, 'store']);

Route::delete('/soundsettings/{id}', [App\Http\Controllers\API\SoundSettingsController::class, 'destroy']);
/*
Route::post("/soundsettings", function() {

    request()->validate([
        'volume' => 'required'
    ]);

    return Song::create([
        'volume' => request('volume'),
        'treble' => request('treble'),
        'mid' => request('mid'),
        'bass' => request('bass')
    ]);

});*/
                            


Route::get("/songs", function() {

    return Song::all();

});


Route::post("/songs", function() {

    request()->validate([
        'title' => 'required',
        'artist' => 'required',
        'genre' => 'required'
    ]);

    return Song::create([
        'title' => request('title'),
        'artist' => request('artist'),
        'genre' => request('genre'),
    ]);

});




Route::put("/songs/{id}", function(Song $id) {

    request()->validate([
        
        'title' => 'required',
        'artist' => 'required',
        'genre' => 'required',
    ]);

    $succes = $id ->update([
        'title' => request('title'),
        'artist' => request('artist'),
        'genre' => request('genre')
    ]);

    return [
        'succes' => $succes
    ];

});


Route::delete('/songs/{id}', function(Song $id){

    $succes = $id->delete();

    return [
        'succes' => $succes
    ];
});