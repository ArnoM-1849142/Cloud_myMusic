var userInfo = null;

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("soundBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var slidersdata;
// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
  fetch("http://127.0.0.1:8000/api/soundsettings")
  .then(response => response.json())
  .then(data => setData(data));
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

async function saveSoundsettings(){
  access_token = localStorage.getItem("access_token");

  if (access_token !== null){
    let userInfo = await getSpotifyUserinfo(access_token);
    let userID = userInfo.id;
    console.log(userID);

    data = {
      volume: bass.value,
      treble: treble.value,
      mid: mid.value,
      bass: bass.value
    }

    fetch("http://127.0.0.1:8000/api/soundsettings", {
      method: "POST", 
      headers: {'Content-Type': 'application/json',},
      body: JSON.stringify(data)
    }).then(res => {
      console.log("Request complete! response:", res);
    });
  }
  else 
  {
    alert("you are not logged in, please log in to save your sound settings");
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