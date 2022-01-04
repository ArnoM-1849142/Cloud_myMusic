const SOUNDSETTINGS = "http://127.0.0.1:8000/api/soundsettings/";
const SOUNDSETTINGSSPECIFIC = "http://127.0.0.1:8000/api/soundsettings/{id}"

var userInfo = null;

var access_token = localStorage.getItem("access_token");
if (access_token !== null){
  getSpotifyUserinfo(access_token);
} else {
  window.location.replace("/loginSpotify");  //redirect to login
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var soundBtn = document.getElementById("soundBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var slidersdata;
// When the user clicks the button, open the modal 
soundBtn.onclick = async function() {
  modal.style.display = "block";
  let soundsettings = await getSoundsettings();
  setData(soundsettings);
}

function setData(data){
  slidersdata = data;

  //set text in volume settings
  volumeText.innerHTML = slidersdata[0].volume + "%";
  trebleText.innerHTML = slidersdata[0].treble + "%";
  midText.innerHTML = slidersdata[0].mid + "%";
  bassText.innerHTML = slidersdata[0].bass + "%";

  //set sliders in volume settings
  volume.value = slidersdata[0].volume;
  treble.value = slidersdata[0].treble;
  mid.value = slidersdata[0].mid;
  bass.value = slidersdata[0].bass;
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

//get sliders
var volume = document.getElementById("volume")
var treble = document.getElementById("treble")
var mid = document.getElementById("mid")
var bass = document.getElementById("bass")


//get textbox id's to put the slider values
var volumeText = document.getElementById("volumeT")
var trebleText = document.getElementById("trebleT")
var midText = document.getElementById("midT")
var bassText = document.getElementById("bassT")

function getSoundsettings(){
  let url = SOUNDSETTINGSSPECIFIC.replace("{id}", userInfo.id)
  return fetch(url)
      .then(response => response.json())
      .then(data => {return data;});
}

async function saveSoundsettings(){
  let soundsettings = await getSoundsettings();
  //console.log(soundsettings[0]);

  if (userInfo === null){
    alert("please log in to save sound settings");
  }
  else if (soundsettings[0] == 'Data not found') //if user has no soundsettings, do POST
  {
    data = {
      id: userInfo.id,
      volume: bass.value,
      treble: treble.value,
      mid: mid.value,
      bass: bass.value
    }
  
    fetch(SOUNDSETTINGS, {
      method: "POST", 
      headers: {'Content-Type': 'application/json',},
      body: JSON.stringify(data)
    }).then(res => {
      console.log("Request complete! response:", res);
    });
  }
  else {                                            // if user already has soundsettings, do PUT
    data = {
      volume: bass.value,
      treble: treble.value,
      mid: mid.value,
      bass: bass.value
    }
    let url = SOUNDSETTINGSSPECIFIC.replace('{id}', userInfo.id);

    fetch(url, {
      method: "PUT", 
      headers: {'Content-Type': 'application/json',},
      body: JSON.stringify(data)
    }).then(res => {
      console.log("Request complete! response:", res);
    });
  }
  
}

async function getSpotifyUserinfo(access_token){ 
  //if userInfo not previously fetched, get from API
  if (userInfo === null){
    userInfo = await fetch("https://api.spotify.com/v1/me", {
    method: "GET", 
    headers: {'Content-Type': 'application/json',
              'Authorization': 'Bearer ' + access_token},
    }).then(response => response.json())
    .then(data => {return data;});
  }
  return userInfo;
}


// update textbox for slidervalues
volume.oninput = function() {
  volumeText.innerHTML = document.getElementById("volume").value + "%";
}

treble.oninput = function() {
  trebleText.innerHTML = document.getElementById("treble").value + "%";
}

mid.oninput = function() {
  midText.innerHTML = document.getElementById("mid").value + "%";
}

bass.oninput = function() {
  bassText.innerHTML = document.getElementById("bass").value + "%";
}