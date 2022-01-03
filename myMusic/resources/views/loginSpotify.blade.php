@extends('layouts.website')

@section('section')

<script class="u-script" type="text/javascript" src="{{asset('assets/loginSpotify.js')}}" defer=""></script>

<section class="u-clearfix u-palette-1-base">
    <div class="u-clearfix u-sheet u-sheet-1">
        <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
            <div class="u-layout">
                <h3 class="u-custom-font u-font-oswald u-text u-text-default u-text-palette-3-base u-text-1">Login with spotify </h3>
                <p class="u-text u-text-9">To get acces to your personal playlists you will have to connect with spotify. 
                    You will be redirected to a spotify authentication page and asked to fill in your credentials. 
                    The types of access that are granteed will be listed aswell. Be sure to check these before proceeding.
                    After logging in you will be redirected to the homepage.
                </p>
                <a class="u-active-white u-border-none u-btn u-btn-round u-button-style u-hover-white u-palette-3-base u-radius-50 u-text-active-palette-1-base u-text-hover-palette-1-base u-text-palette-1-base u-btn-1 button">
                    Log in with spotify
                </a>
            </div>
        </div>
    </div>
</section>

@endsection