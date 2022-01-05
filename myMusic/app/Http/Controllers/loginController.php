<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class loginController extends Controller
{

    /**
     * Display the spotify login explanation and reques page to the user
     * 
     * @return \Illuminate\Http\Response loginSpotify html page
     */
    public function loginSpotify(){
        return view("loginSpotify");
    }

    public function loggedin(Request $request){

        if (isset($_GET['code'])) {

            $code = $_GET['code'];
            $state = $_GET['state'];
            throw_unless(
                strlen($state) > 0 && $state === $request->state,
                InvalidArgumentException::class
            );

            $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => 'authorization_code',
                'client_id' => getenv("SPOTIFY_CLIENT_ID"),
                'client_secret' => getenv("SPOTIFY_CLIENT_SECRET"),
                'redirect_uri' => 'http://localhost:8000/loggedin',
                'code' => $code,
            ]);
            $data = $response->json();

            $accessToken = $data["access_token"];
            $refreshToken = $data["refresh_token"];

            return view("loggedin")->with("accessToken", $accessToken)
                                    ->with("refreshToken", $refreshToken);
        } else {
            return redirect('/loginSpotify');
        }
    }

    /**
     * create header for Spotify authorization request.
     * @param request Http request
     * @return redirect Redirects to the spotify authorize url
     */
    public function redirectAuthorize(Request $request){
        $request->session()->put('state', $state = Str::random(40));
    
        $query = http_build_query([
            'client_id' => getenv("SPOTIFY_CLIENT_ID"),
            'redirect_uri' => 'http://localhost:8000/loggedin',
            'response_type' => 'code',
            'scope' => 'user-read-private user-read-email user-modify-playback-state user-read-playback-position user-library-read streaming user-read-playback-state user-read-recently-played playlist-read-private',
            'state' => $state,
        ]);
    
        return redirect("https://accounts.spotify.com/authorize?".$query);
    }
}