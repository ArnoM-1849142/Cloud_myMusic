function evenementInfoBlock(id, title = "no title", date = "01/01/2000", location="no location", description="no description", start="00:00", ending="00:00"){
return '<div class="u-container-style u-gradient u-list-item u-repeater-item u-list-item-1"  onClick="showDetail(' + id + ')" id="eventBlock' + id + '">\
            <div class="u-container-layout u-similar-container u-container-layout-3">\
              <div class="u-container-style u-grey-50 u-group u-opacity u-opacity-30 u-shape-rectangle u-group-1">\
                  <div class="u-container-layout u-container-layout-4"> <span class="u-file-icon u-icon u-icon-circle u-text-palette-1-base u-icon-1"><img src="images/myMusic2.png" alt=""></span>\
                    <h4 class="u-text u-text-default u-text-3">' + title + '</h4>\
                <div class="u-border-3 u-border-grey-dark-1 u-line u-line-horizontal u-line-1"></div>\
                <h5 class="u-text u-text-4">' + 'location: ' + location + '</h5>\
                <h5 class="u-text u-text-default u-text-5">' +  date  + '</h5>\
                <h6 class="u-text u-text-6">' + 'Starting: ' + start +'</h6>\
                <h6 class="u-text u-text-7">'  + 'Ending: ' + ending + '</h6>\
                <p class="u-text u-text-8">' +  description  +' </p>\
              </div>\
              </div>\
              </div>\
            </div>';

}


evenementrepeater = document.getElementById('evenement-repeater');



const showEvenements = async () => {
    const response = await fetch('https://mymusicpythonservice.herokuapp.com/Evenements');
    const json = await response.json();
    showEvents(json);
    console.log(json);
}

showEvenements();

/*
function showEvenements(){
    fetch('https://mymusicpythonservice.herokuapp.com/Evenements')
    .then(response => response.json())
    .then(data => showEvents(data));
    alert("data:" + data)
   
*/

var newEventform = document.getElementById("newEventform");

function openEventForum(){
  newEventform.style.display = "block";
  document.getElementById("submitEventBtn").style.display = "block";
  document.getElementById("editEventBtn").style.display = "none";
}

var title = document.getElementById("name-3b9a");
var date = document.getElementById("date-6ecd");
var description = document.getElementById("message-3b9a");
var tracker = document.getElementById("address-1814");
var starth = document.getElementById("text-b90c");
var endh = document.getElementById("text-aa65");

function createNewEvenement(){

  if (date.value == "" || tracker.value == "" || description.value == "" || starth.value == "" || endh.value == "" ){
    alert("Please fill in all fields before sending it to our database")

  }else{

    var jsoncontect = {"title": title.value,
          "date": String(date.value),
          "location": tracker.value,
          "description": description.value,
          "start": starth.value,
          "ending": endh.value,
          }

      fetch('https://mymusicpythonservice.herokuapp.com/Evenements', {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(jsoncontect)
    });
    
    newEventform.style.display = "none";

    showEvenements();
  }
}


function showEvents(data){
  evenementrepeater.innerHTML= "";
    for (let [key, value] of Object.entries(data)) {
        evenementrepeater.innerHTML += evenementInfoBlock(
            value['id'],
            value['title'],
            value['date'],
            value['location'],
            value['description'],
            value['start'],
            value['ending'],
          );
      }
}

function getData(data){
  title.value = data["title"];
  //date.value = data["date"];
  tracker.value = data["location"];
  description.value = data["description"];
  starth.value = data["start"];
  endh.value = data["ending"];
}


var tempEventId

function showDetail(event_id){
  openEventForum();
  tempEventId = event_id;
  alert("tempEventId:  " + tempEventId);
  document.getElementById("submitEventBtn").style.display = "none";
  document.getElementById("editEventBtn").style.display = "block";
  fetch('https://mymusicpythonservice.herokuapp.com/Evenement/'+ event_id)
    .then(response => response.json())
    .then(data => getData(data));
}


function editEvenement(){
  if (date.value == "" || tracker.value == "" || description.value == "" || starth.value == "" || endh.value == "" ){
    alert("Please fill in all fields before sending it to our database")

  }else{

    var jsoncontect = {"title": title.value,
          "date": String(date.value),
          "location": tracker.value,
          "description": description.value,
          "start": starth.value,
          "ending": endh.value,
          }

      fetch('https://mymusicpythonservice.herokuapp.com/Evenement/'+ tempEventId, {
      method: 'PUT',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(jsoncontect)
    });
    alert("PUT method is executed")
    newEventform.style.display = "none";

    showEvenements();
  }
}