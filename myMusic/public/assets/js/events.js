
//fucntion to fetch evenements froum the database with our GET method of our API server
const fetchEvenements = async () => {
    const response = await fetch('https://mymusicpythonservice.herokuapp.com/Events');
    const json = await response.json();
    console.log(json);
    showEvents(json);
}

fetchEvenements();



var deleteSelector = document.getElementById("deleteSelector");
var evenementrepeater = document.getElementById('evenement-repeater');


//show all events on the homepage in the repeater
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


  // add elements to the selectionbox in the delete box
  for (const [key, value] of Object.entries(data)) {
    deleteSelector.innerHTML += "<option style=\"color:gray\" name='name' value=" +'"'+ value['id'] + '"' +" >" + value['title'] + "</option>";
  }

}





var newEventform = document.getElementById("newEventform");

// open the forum to create a new event on the homepage
function openEventForum(){
  newEventform.style.display = "block";
  document.getElementById("submitEventBtn").style.display = "block";
  document.getElementById("editEventBtn").style.display = "none";
  forumTitle.innerHTML = "Add your event to promote your music group!"
  forumDescrp.innerHTML = "When creating this evenement, it will be added to our list of events what everyone can see on our myMusic page."
}





var title = document.getElementById("name-3b9a");
var date = document.getElementById("date-6ecd");
var description = document.getElementById("message-3b9a");
var tracker = document.getElementById("address-1814");
var starth = document.getElementById("text-b90c");
var endh = document.getElementById("text-aa65");

// function to create a new database and send this event with our own created API to the database

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

      fetch('https://mymusicpythonservice.herokuapp.com/Events', {
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



// create a block where al the info of our evenement will be put in. After this it will be displayed on the homepage

function evenementInfoBlock(id, title = "no title", date = "01/01/2000", location="no location", description="no description", start="00:00", ending="00:00"){
  return '<div class="u-container-style u-gradient u-list-item u-repeater-item u-list-item-1"  onClick="showDetail(' + id + ')" id="eventBlock' + id + '">\
              <div class="u-container-layout u-similar-container u-container-layout-3">\
                <div class="u-container-style u-grey-50 u-group u-opacity u-opacity-30 u-shape-rectangle u-group-1">\
                    <div class="u-container-layout u-container-layout-4">\
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





var forumTitle = document.getElementById("forumTitle");
var forumDescrp = document.getElementById("forumDescrp"); 
var tempEventId

function showDetail(event_id){
  openEventForum();
  forumTitle.innerHTML = "Edit your chosen event:"
  forumDescrp.innerHTML = "don't forget to put in the date again! Otherwhise it will not work"
  tempEventId = event_id;
  alert("tempEventId:  " + tempEventId);
  document.getElementById("submitEventBtn").style.display = "none";
  document.getElementById("editEventBtn").style.display = "block";
  fetch('https://mymusicpythonservice.herokuapp.com/Event/'+ event_id)
    .then(response => response.json())
    .then(data => getData(data));
}


//get data out of the chosen id 
function getData(data){
  title.value = data["title"];
  //date.value = data["date"];
  tracker.value = data["location"];
  description.value = data["description"];
  starth.value = data["start"];
  endh.value = data["ending"];
}





// open the forum with the chosen event inside to edit this event.
// the event is fetched with an GET API with the ID, and when edited and submited it will be send to the database with the PUT method and the json body
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

      fetch('https://mymusicpythonservice.herokuapp.com/Event/'+ tempEventId, {
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



//delete chosen evenement with the DELETE method as API request for our API server with database
function deleteEvenement(){
  alert("selected event: " + deleteSelector.value);
  fetch('https://mymusicpythonservice.herokuapp.com/Event/'+deleteSelector.value, {
    method: 'DELETE'
  })
  showEvenements();
}