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
        return view("homepage");
    }
    
}