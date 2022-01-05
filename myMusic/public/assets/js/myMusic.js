const PLAYLISTS = "https://api.spotify.com/v1/me/playlists";
const DEVICES = "https://api.spotify.com/v1/me/player/devices";
const PLAY = "https://api.spotify.com/v1/me/player/play";
const PAUSE = "https://api.spotify.com/v1/me/player/pause";
const NEXT = "https://api.spotify.com/v1/me/player/next";
const PREVIOUS = "https://api.spotify.com/v1/me/player/previous";
const PLAYER = "https://api.spotify.com/v1/me/player";
const TRACKS = "https://api.spotify.com/v1/playlists/{{PlaylistId}}/tracks";
const CURRENTLYPLAYING = "https://api.spotify.com/v1/me/player/currently-playing";
const SHUFFLE = "https://api.spotify.com/v1/me/player/shuffle";

if ((access_token === null) || (refresh_token === null)){ //check if tokens where previously saved in session
    access_token = localStorage.getItem("access_token");
    refresh_token = localStorage.getItem("refresh_token");
    if ((localStorage.getItem("access_token") === null) || (refresh_token = localStorage.getItem("refresh_token") === null)){
        // code to prompt user to log in
        alert("please log in to your spotify account");
        window.location.replace("/loginSpotify");
    }
}


function refreshPlaylists(){
    callApi( "GET", PLAYLISTS, null, handlePlaylistsResponse );
}

function handlePlaylistsResponse(){
    if ( this.status == 200 ){
        var data = JSON.parse(this.responseText);
        console.log(data);
        //removeAllItems( "playlists" );
        data.items.forEach(item => addPlaylist(item));
    }
    else if ( this.status == 401 ){
        refreshAccessToken()
    }
    else {
        console.log(this.responseText);
        alert(this.responseText);
    }
}

function addPlaylist(item){
    let node = document.createElement("div");
    node.id = "playlist" + item.id;
    node.value = item.id;
    let imgurl;
    if (item.images.length > 0) {
        imgurl = item.images[0].url;
    } else {
        imgurl = '{{asset(\'assets/images/f2d4860e6f52543c49d6d7404cddf014f5a237e81416813936c182c19c6b3dbb23e5f6cf53ca08b3ba15a4ccb63c33dc94e889c943d69deebaf288_1280.jpg\')}}';
    }
    node.innerHTML = '<div class="u-container-layout u-similar-container u-container-layout-2">\
                        <img class="u-image u-image-circle u-image-1" src="'+imgurl+'" alt="" data-image-width="1280" data-image-height="1024">\
                        <h3 class="u-text u-text-default u-text-3">Playlist: '+item.name+' </h3>\
                    </div>';
    document.getElementById("playlists").appendChild(node);
}

function refreshDevices(){
    callApi( "GET", DEVICES, null, handleDevicesResponse );
}

function handleDevicesResponse(){
    if ( this.status == 200 ){
        var data = JSON.parse(this.responseText);
        console.log(data);
        //removeAllItems( "devices" );
        //data.devices.forEach(item => addDevice(item));
    }
    else if ( this.status == 401 ){
        refreshAccessToken()
    }
    else {
        console.log(this.responseText);
        alert(this.responseText);
    }
}

function addDevice(item){
    let node = document.createElement("option");
    node.value = item.id;
    node.innerHTML = item.name;
    document.getElementById("devices").appendChild(node); 
}

function fetchTracks(){
    //let playlist_id = document.getElementById("playlists").value;
    if ( playlist_id.length > 0 ){
        url = TRACKS.replace("{{PlaylistId}}", playlist_id);
        callApi( "GET", url, null, handleTracksResponse );
    }
}

function handleTracksResponse(){
    if ( this.status == 200 ){
        var data = JSON.parse(this.responseText);
        console.log(data);
        //removeAllItems( "tracks" );
        //data.items.forEach( (item, index) => addTrack(item, index));
    }
    else if ( this.status == 401 ){
        refreshAccessToken()
    }
    else {
        console.log(this.responseText);
        alert(this.responseText);
    }
}

function addTrack(item, index){
    let node = document.createElement("option");
    node.value = index;
    node.innerHTML = item.track.name + " (" + item.track.artists[0].name + ")";
    document.getElementById("tracks").appendChild(node); 
}

// !!! requires filling in !!! //
function refreshAccessToken(){
    alert("Session expired, please log in again");
    localStorage.removeItem("access_key");
    localStorage.removeItem("refresh_key");
    window.location.replace("/loginSpotify");
}

function callApi(method, url, body, callback){
    let xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('Authorization', 'Bearer ' + access_token);
    xhr.send(body);
    xhr.onload = callback;
}