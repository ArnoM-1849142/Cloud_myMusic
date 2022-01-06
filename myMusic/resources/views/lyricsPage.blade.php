<?php
?>


@extends('layouts.website')

@section('content')

<script class="u-script" type="text/javascript" src="{{ URL::asset('assets/js/myMusic.js') }}"></script>
<script class="u-script" type="text/javascript" src="{{ URL::asset('assets/js/spotifyAPI.js') }}"></script>


 <!--<img id="soundBtn" src="{{asset('assets/images/soundicon.png')}}" width="35" height="35" style="position: fixed;  z-index: 999; top: 20px;  right: 20px; "/>-->
 <div onclick="openSoundSettings()" style="height: 50px; position: fixed;  z-index: 999; top: 25px;  right: 25px; ">
  <svg id="soundBtn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="100%" viewBox="0 0 104 80" version="1.1">
      <desc>Sound button</desc>
      <defs/>
      <g id="3.Multimedia" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
          <g id="Multimedia-(Stroke)" transform="translate(-498.000000, -112.000000)" stroke="#263238" stroke-width="3.5">
              <g id="3-multimeda-sound-loud" transform="translate(500.000000, 114.000000)">
                  <path class="soundbuttonfill" d="M15,53 L2.99942248,53 C1.34288718,53 0,51.6526814 0,49.9999809 L0,26.0000191 L0,26.0000191 C0,24.3431543 1.34435073,23 2.99942248,23 L15,23" id="Layer-1"/>
                  <path class="soundbuttonfill" fill="#efab47" d="M41.1547359,0.941677165 C43.2784166,-0.827905208 45,-0.0318034532 45,2.72842698 L45,73.0157762 C45,75.7721532 43.2793189,76.5728602 41.1547359,74.802526 L15,53.0087794 L15,22.7354238 L41.1547359,0.941677165 Z" id="Layer-2"/>
                  <path class="soundbuttonstroke" d="M73,75.1369725 C88.5904175,70.0307768 99.8510697,55.363628 99.8510697,38.0664131 C99.8510697,20.7738776 88.5965095,6.10998553 73.0126522,1" id="Layer-3"/>
                  <path class="soundbuttonstroke" d="M67,61.4633961 C77.3361812,58.7887497 84.9700853,49.3994824 84.9700853,38.2272212 C84.9700853,27.0673922 77.3531613,17.6865911 67.0344952,15" id="Layer-4"/>
                  <path class="soundbuttonstroke" d="M60,48 L60,48 C60.7092383,48 61.4012316,47.9261654 62.0687127,47.7857633 C66.5989154,46.8328525 70,42.8136092 70,38 C70,33.1154054 66.4978654,29.0487782 61.8675653,28.1740873 C61.2625401,28.0597945 60.6382529,28 60,28" id="Layer-5"/>
              </g>
          </g>
      </g>
  </svg>
</div>

 <!-- The Modal -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div>
      <span class="close">&times;</span>
      <div class="slidecontainer">
        <div class="center">
          <div style="display: flex; align-items: center;">
            <div class="darktext">Volume: </div>
            <div class="darktext" id="volumeT">50 %</div>
          </div>
          <input type="range" min="0" max="100" value="50" class="slider"  id="volume">
        </div>
        <div class="center">
          <div style="display: flex; align-items: center;">
            <div class="darktext">treble: </div>
            <div class="darktext" id="trebleT">50 %</div>
          </div>
          <input type="range" min="0" max="100" value="50" class="slider" id="treble">
        </div>
        <div class="center">
          <div style="display: flex; align-items: center;">
            <div class="darktext">mid: </div>
            <div class="darktext" id="midT">50 %</div>
          </div>
          <input type="range" min="0" max="100" value="50" class="slider" id="mid">
        </div>
        <div class="center">
          <div style="display: flex; align-items: center;">
            <div class="darktext">bass: </div>
            <div class="darktext" id="bassT">50 %</div>
          </div>
          <input type="range" min="0" max="100" value="50" class="slider" id="bass">
        </div>
      </div>
    </div>
    <div class="centerinside">
      <input type="button" value="Save" onclick="saveSoundsettings()" class="u-active-white u-border-none u-btn u-btn-round u-button-style u-hover-white u-palette-3-base u-radius-50 u-text-active-palette-1-base u-text-hover-palette-1-base u-text-palette-1-base u-btn-1 button">
    </div>
  </div>
</div>

<script class="u-script" type="text/javascript" src="{{asset('assets/soundsettings.js')}}" ></script>
<link rel="stylesheet" type="text/css" href="{{asset('assets/soundsettings.css')}}" />

<div class="u-clearfix u-sheet u-sheet-1">      
    <div class="search-box">
        <div class="text-padded" style="display: flex; width: 100%">
            <div style="width: 50%;">
                <div style="display: flex; flex-direction:column; width: fit-content;">
                    <h3 class="u-text u-text-default u-text-palette-3-base u-text-8">Search a song!</h3>
                    <div class="u-border-10 u-border-palette-3-base u-line u-line-horizontal u-line-1" style="width: auto;"></div>
                </div>
                <p class="u-text u-text-9">Search a song by its title. This will return a list of songs.
                        You will than be able to select a song and look at its lyrics (censored/uncensored)
                </p>
            </div>
            <div id="track-input-container">
                <div style="width: 400px; bottom:0px; right:0px; position:absolute; margin-bottom: 20px;">
                    <input type="text" id="trackInput" name="track" value="enter a track title" minlength="4" style="color: black; width:100%;">
                    <button onclick="getSongsByTitle()" style="margin-bottom:0px; margin: top 10px;" class="u-active-white u-border-none u-btn u-btn-round u-button-style u-hover-white u-palette-3-base u-radius-50 u-text-active-palette-1-base u-text-hover-palette-1-base u-text-palette-1-base u-btn-1 button">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection



