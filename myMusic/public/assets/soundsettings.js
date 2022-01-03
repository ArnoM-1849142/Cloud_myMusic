
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("soundBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var textboxhttp = document.getElementById("textboxrequest");


// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
  fetch("http://127.0.0.1:8000/api/soundsettings")
  .then(response => response.json())
  .then(data => showdata(data));
}

function showdata(data){
  console.log(data);
  textboxhttp.innerHTML=data;
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