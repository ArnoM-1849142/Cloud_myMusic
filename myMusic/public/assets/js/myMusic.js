access_token = localStorage.getItem("access_token");
refresh_token = localStorage.getItem("refresh_token");

if ((access_token === null) || (refresh_token === null)){ //check if tokens where previously saved in session
    alert("please log in to your spotify account");
    window.location.replace("/loginSpotify");
}


// !!! requires filling in !!! //
function refreshAccessToken(){
    alert("Session expired, please log in again");
    localStorage.removeItem("access_key");
    localStorage.removeItem("refresh_key");
    window.location.replace("/loginSpotify");
}

var userInfo = null;

//var access_token = localStorage.getItem("access_token");
if (access_token !== null){
  initializeUser(access_token);
} else {
  window.location.replace("/loginSpotify");  //redirect to login
}

async function initializeUser(){
    userInfo = await getSpotifyUserinfo(access_token);
    if (userInfo.error != undefined) {
        if (userInfo.error.status>299){
            alert("login failed, please try again. Error = " + error);
            window.location.replace("/loginSpotify");  //redirect to login
        }
    }
    setUserInfoInHeader();
}

function setUserInfoInHeader(){
    let userInfoBlock = document.getElementById("user-info");
    userInfoBlock.innerHTML = userInfo.display_name;
}

async function getSpotifyUserinfo(access_token){ 
    //if userInfo not previously fetched, get from API
    if (userInfo === null){
        userInfo = await fetch("https://api.spotify.com/v1/me", {
        method: "GET", 
        headers: {'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + access_token},
        }).then(response => response.json())
        .then(data => {return data;})
        .catch(error => {
        alert("login failed, please try again. Error = " + error);
        window.location.replace("/loginSpotify");  //redirect to login
        });
    }
    return userInfo;
}

