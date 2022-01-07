<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use SoapClient;

class myMusicController extends Controller
{
    

    /**
     * Display the main app page.
     *
     * @return \Illuminate\Http\Response hompage html page
     */
    public function index(){

        return view("homepage");

    }

    /**
     * Display the page for lyric searching and censoring.
     *
     * @param \Illuminate\Http\Request 
     * @return \Illuminate\Http\Response lyrics html page
     */
    public function showSongsPage(){

        return view("songsPage");

    }


    public function getSongLyrics(){

        if (isset($_GET['title']) && isset($_GET['artist'])){

            $title = $_GET['title'];
            $artist = $_GET['artist'];
            Log::info("title = ".$title);
            Log::info("artist = ".$artist);

            $client = new SoapClient("http://api.chartlyrics.com/apiv1.asmx?WSDL");
            Log::info(implode("|",$client->__getFunctions()));
            Log::info(implode("|",$client->__getTypes()));

            $searchlyric = new SearchLyric($artist, $title);

            $response = $client->__soapCall("searchLyricDirect", array($searchlyric));

            $lyric = $response->SearchLyricDirectResult->Lyric;
            //Log::info($lyric);

            return view("lyricsPage")->with("lyric", $lyric)
                                        ->with("song", $title)
                                        ->with("artist", $artist);
        } 
        else 
        {
            return response()->json(['Title or artist not found in request'],404);
        }
    }
}

// SearchLyric type
class SearchLyric {
            
    public function __construct($artist, $song)
    {
        $this->artist = $artist;
        $this->song = $song;
    }
}