<?php
$songs = array("lalala", "jodela", "i'm blue");
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
<link rel="stylesheet" type="text/css" href="{{ asset('assets/soundsettings.css') }}" />



<section class="u-clearfix u-palette-1-base u-section-6" id="carousel_070c">

<div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
  <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
    <div class="u-layout">
      <div class="u-layout-row">
        <div class="u-container-style u-layout-cell u-left-cell u-size-22 u-layout-cell-1">
          <div class="u-container-layout u-valign-top u-container-layout-1">
            <h3 class="u-custom-font u-font-oswald u-text u-text-palette-3-base u-text-1"> Music events &amp; <br> Artists</h3>
            <p class="u-text u-text-body-alt-color u-text-2"> Promote yourself!
            </p>
          </div>
        </div>
        <div class="u-container-style u-layout-cell u-right-cell u-size-38 u-layout-cell-2">
          <div class="u-container-layout u-container-layout-2">
            <p class="u-text u-text-3"> The overview below is a listing of upcoming events where you can go to and listen to the best new music.  This list contains event added by all members of the myMusic community. You too can contribute events here to promote yourself! </p>
            <a onclick="openEventForum()" id="newEvBtn" class="u-active-white u-border-none u-btn u-btn-round u-button-style u-hover-white u-palette-3-base u-radius-50 u-text-active-palette-1-base u-text-hover-palette-1-base u-text-palette-1-base u-btn-2"> add evenement </a>
          </div>
        </div>
      </div>
    </div>
  </div>


    <!-- add event forum -->
<div style="z-index: 2; margin-left: auto; margin-right: auto;  display: block;" >
  <div id="newEventform" class="u-clearfix u-sheet u-valign-middle u-sheet-1" style="z-index: 5; display: none;">
    <div class="forum-background">
      <div class="u-container-layout u-container-layout-1">
              <h1 class="u-text u-text-default u-text-palette-1-base u-text-1 bold-text">Add your event to promote your music group!</h1>
              <h3 class="u-text u-text-default u-text-2">When creating this event, it will be added to our list of events what everyone can see on our myMusic page.</h3>
              <div class="u-form u-form-1">
                <form  class="u-clearfix u-form-spacing-30 u-form-vertical u-inner-form" style="padding: 0px;" source="custom" name="form">
                  <div class="u-form-group u-form-name">
                    <label for="name-3b9a" class="u-label" wfd-invisible="true">title</label>
                    <input type="text" placeholder="Enter title of the evenement" id="name-3b9a" name="title" class="u-border-2 u-border-white u-input u-input-rectangle u-radius-16 u-white u-input-1" required="">
                  </div>
                  <div class="u-form-date u-form-group u-form-group-2">
                    <label for="date-6ecd" class="u-label">date</label>
                    <input type="date" placeholder="MM/DD/YYYY" id="date-6ecd" name="date-1" class="u-border-2 u-border-white u-input u-input-rectangle u-radius-16 u-white u-input-2" required="">
                  </div>
                  <div class="u-form-group u-form-partition-factor-2 u-form-group-3">
                    <label for="text-b90c" class="u-label"> Starting hour</label>
                    <input type="text" placeholder="Starting hour" id="text-b90c" name="text" class="u-border-2 u-border-white u-input u-input-rectangle u-radius-16 u-white u-input-3" required="required">
                  </div>
                  <div class="u-form-group u-form-partition-factor-2 u-form-group-4">
                    <label for="text-aa65" class="u-label">Ending hour</label>
                    <input type="text" id="text-aa65" name="text-1" id="text-aa65"  class="u-border-2 u-border-white u-input u-input-rectangle u-radius-16 u-white u-input-4" placeholder="Ending hour">
                  </div>
                  <div class="u-form-address u-form-group u-form-group-5">
                    <label for="address-1814" class="u-label">adress</label>
                    <input type="text" placeholder="Enter the adress of the evenement" id="address-1814" name="address" class="u-border-2 u-border-white u-input u-input-rectangle u-radius-16 u-white u-input-5" required="">
                  </div>
                  <div class="u-form-group u-form-message">
                    <label for="message-3b9a" class="u-label" wfd-invisible="true">Description</label>
                    <textarea placeholder="Descripe your evenement" rows="4" cols="50" id="message-3b9a" name="message" class="u-border-2 u-border-white u-input u-input-rectangle u-radius-16 u-white u-input-6" required=""></textarea>
                  </div><div class="float-container">
                  <div class="float-child">
                    <div class="u-form-group u-form-submit" >
                        <a id="submitEventBtn" style="display: block" onclick = "createNewEvenement()" href="#" class="u-active-palette-1-light-1 u-border-1 u-border-white u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-11 u-text-body-alt-color u-btn-1">Submit</a>
                    <div class="float-child">
                    <div class="u-form-group u-form-submit">
                          <a id="editEventBtn" style="display: none" onclick = "editEvenement()" href="#" class="u-active-palette-1-light-1 u-border-1 u-border-white u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-11 u-text-body-alt-color u-btn-1">Edit Event</a>
                    </div>
                  </div>
                  <div class="u-form-send-message u-form-send-success" wfd-invisible="true"> Thank you! Your message has been sent. </div>
                  <div class="u-form-send-error u-form-send-message" wfd-invisible="true"> Unable to send your message. Please fix errors then try again. </div>
                  <input  type="hidden" value="" name="recaptchaResponse" wfd-invisible="true">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


   <!-- evenement list -->
    <div class="u-list u-list-1" id="evenementList" style=" margin-left: auto; margin-right: auto; padding-block-start:50px; display: block;">
      <div class="u-repeater u-repeater-1" id="evenement-repeater">
      </div>
    </div>

    <!-- delete container -->
    <div class="u-container-style u-gradient u-list-item u-repeater-item u-list-item-2">
      <div class="u-container-layout u-similar-container u-container-layout-delete">
        <div class="u-container-style u-grey-50 u-group u-opacity u-opacity-30 u-shape-rectangle u-group-12">
          <div class="u-container-layout u-container-layout-6"><span class="u-file-icon u-icon u-icon-circle u-text-palette-1-base u-icon-2"> <img src="{{asset('assets/images/myMusic2.png')}}" alt=""></span>
            <h3 class="u-text u-text-default u-text-9">Delete event</h3>
            <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-2"></div>
            <p class="u-text u-text-14">To show our REST delete function, can in the box an event be chosen and deleted from the database</p>
              <p></p>
              <select id="deleteSelector" style="width: 450px; color:gray;"> <!--onchange="slaapkamerSelect(this.options[this.selectedIndex].value)" -->
                <option  name='name' value=" choose evenement "></option>
              </select>
              <p></p>
              <a id="submitEventBtn" style="display: block; float: left;" onclick = "deleteEvenement()" href="#" class="u-active-palette-1-light-1 u-border-1 u-border-white u-btn u-btn-round u-btn-submit u-button-style u-hover-palette-1-light-1 u-palette-1-base u-radius-11 u-text-body-alt-color u-btn-1">DELTE EVENT</a>
          </div>
        </div>
      </div>
    </div>


</section>


<script class="u-script" type="text/javascript" src="{{asset('assets/js/evenements.js')}}" ></script>


@endsection


