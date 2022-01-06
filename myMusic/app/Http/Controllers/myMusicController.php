<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
    public function showLyricsPage(){

        return view("lyricsPage");

    }
}