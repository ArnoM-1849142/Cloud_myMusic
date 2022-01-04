<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class myMusicController extends Controller
{
    

    /**
     * Display the main app page.
     *
     * @return \Illuminate\Http\Response hompage html page
     */
    public function index(Request $request){
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            //$state = $request->session()->pull('state');
            $state = $_GET['state'];
            throw_unless(
                strlen($state) > 0 && $state === $request->state,
                InvalidArgumentException::class
            );

            $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => 'authorization_code',
                'client_id' => 'acf9eea5972a4da5a92eb8201bae12f6',
                'client_secret' => 'f83c6fde33844e289421ffbf4b5ead17',
                'redirect_uri' => 'http://localhost:8000',
                'code' => $code,
            ]);
            $data = $response->json();

            $accessToken = $data["access_token"];
            $refreshToken = $data["refresh_token"];
            $expiresIn = $data["expires_in"];

            $query = http_build_query([
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken
            ]);

            //return view("homepage")->with("accessToken", $accessToken)
            //                        ->with("refreshToken", $refreshToken)
            //                        ->with("expiresIn", $expiresIn);
            return redirect("http://localhost:8000?".$query);
        } elseif (isset($_GET['access_token']) && isset($_GET['refresh_token'])) {
            return view("homepage")->with("accessToken", $_GET['access_token'])
                                    ->with("refreshToken", $_GET['refresh_token']);
        } else {
            return view("homepage");
        }  
    }

    /**
     * Display the spotify login explanation and reques page to the user
     * 
     * @return \Illuminate\Http\Response loginSpotify html page
     */
    public function loginSpotify(){
        return view("loginSpotify");
    }

    /**
     * create header for Spotify authorization request.
     * @param request Http request
     * @return redirect Redirects to the spotify authorize url
     */
    public function redirectAuthorize(Request $request){
        $request->session()->put('state', $state = Str::random(40));
    
        $query = http_build_query([
            'client_id' => 'acf9eea5972a4da5a92eb8201bae12f6',
            'redirect_uri' => 'http://localhost:8000',
            'response_type' => 'code',
            'scope' => 'user-read-private user-read-email user-modify-playback-state user-read-playback-position user-library-read streaming user-read-playback-state user-read-recently-played playlist-read-private',
            'state' => $state,
        ]);
    
        return redirect("https://accounts.spotify.com/authorize?".$query);
    }
}