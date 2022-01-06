function evenementInfoBlock(id, title = "no title", date = "01/01/2000", location="no location", description="no description", image="NULL"){
return '<div class="u-container-style u-image u-list-item u-repeater-item u-shading u-image-1" data-image-width="2000" data-image-height="1333">\
            <div class="u-container-layout u-similar-container u-container-layout-3"><span class="u-file-icon u-icon u-icon-circle u-text-palette-1-base u-icon-1"> <img src="{{asset(\'assets/images/myMusic2.png\')}}" alt=""></span>\
                <div class="u-container-style u-expanded-width u-group u-opacity u-opacity-50 u-palette-1-base u-shape-rectangle u-group-1">\
                  <div class="u-container-layout u-container-layout-4">\
                    <h4 class="u-text u-text-default u-text-3">' + title + '</h4>\
                  </div>\
                </div>\
                <div class="u-border-3 u-border-grey-dark--1 u-line u-line-horizontal u-line-1"></div>\
                <h5 class="u-text u-text-default u-text-4">' + date + '</h5>\
                <h5 class="u-text u-text-default u-text-5">' + location + '</h5>\
                <p class="u-text u-text-default u-text-6">' + description +' </p>\
              </div>\
            </div>';

}



evenementrepeater = document.getElementById('evenement-repeater');


window.onload = function showEvenements(){
  
    fetch('https://mymusicpythonservice.herokuapp.com/Evenements')
    .then(response => response.json())
    .then(data => showEvents(data));
   
}

// Get the modal
var modal = document.getElementById("newEventModal");


var jsoncontect = {"title": "examen IOT",
"date": "28/041/2022",
"location": "H-E207",
 "description": "Docent(en) dinges"}

function openEventModal(){
    modal.style.display = "block";
}

var title = document.getElementById("name-3b9a");
var date = document.getElementById("date-6ecd");

var description = document.getElementById("message-3b9a");

var tracker = document.getElementById("address-1814");

function createNewEvenement(){

  var jsoncontect = {"title": title.value,
        "date": String(date.value),
        "location": tracker.value,
        "description": description.value}

    fetch('https://mymusicpythonservice.herokuapp.com/Evenements', {
    method: 'POST',
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(jsoncontect)
  });
  modal.style.display = "none";

  showEvenements();
}


function showEvents(data){
  evenementrepeater.innerHTML= "";
    for (let [key, value] of Object.entries(data)) {
        evenementrepeater.innerHTML += evenementInfoBlock(
            key,
            value['title'],
            value['date'],
            value['location'],
            value['description']
          );
      }
}