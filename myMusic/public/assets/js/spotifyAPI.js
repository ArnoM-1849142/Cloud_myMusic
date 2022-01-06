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
const TRACKSBYTITLE = "https://api.spotify.com/v1/search";

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

function getSongsByTitle(){
    trackTitle = document.getElementById("trackInput").value;
    url = TRACKSBYTITLE + "?q=track:" + trackTitle + "&type=track"
    callApi("GET", url, null, handleSongsResponse)
}

var songslist;

function handleSongsResponse(){
    if (this.status == 200){
        var data = JSON.parse(this.responseText);
        console.log(data);
        let tracks = data.tracks.items;
        songslist = tracks;
        setSongsCards(tracks);
    }
    else if (this.status == 401){
        refreshAccessToken();
    }
    else {
        console.log(this.responseText);
        alert(this.responseText);
    }
}

function setSongsCards(songslist){
    grid = document.getElementById("search-results-grid");
    grid.innerHTML = '';    //remove all existing children

    for (const [key, value] of Object.entries(songslist)){
        imageref = value.album.images[0].url;
        title = value.name;
        artist = value.artists[0].name;
        album = "Album: " + value.album.name;
        grid.appendChild(searchResultsCard(imageref, title, artist, album, value.id, value));
    }
}

//<div class="search-results-card">
//        <img class="u-image u-image-contain u-image-default u-image-1 search-card-image" src="{{asset('assets/images/silhouette-young-lady-crowd-during-concert_181624-27673.jpg')}}" alt="" data-image-width="349" data-image-height="302">
//        <div class="search-results-card-text">
//          <h3>Title of the song</h3>
//          <h4>Artist Names</h4>
//          <h5>album</h5>
//        </div>
//      </div>
function searchResultsCard(imageref, title, artist, addition, id, object){
    let card = document.createElement("div");
    card.classList.add("search-results-card");
    card.id = id;
    card.value = object;

    let img = document.createElement("img");
    img.src = imageref;
    img.classList.add("u-image");
    img.classList.add("u-image-contain");
    img.classList.add("u-image-default");
    img.classList.add("u-image-1");
    img.classList.add("search-card-image");;

    let textdiv = document.createElement("div");
    textdiv.classList.add("search-results-card-text");

    let titletext = document.createElement("h3");
    titletext.innerHTML = title;

    let artisttext = document.createElement("h4");
    artisttext.innerHTML = artist;

    let additiontext = document.createElement("addition");
    additiontext.innerHTML = addition;

    textdiv.append(titletext, artisttext, addition);
    card.append(img, textdiv);

    return card;
}

function addTrack(item, index){
    let node = document.createElement("option");
    node.value = index;
    node.innerHTML = item.track.name + " (" + item.track.artists[0].name + ")";
    document.getElementById("tracks").appendChild(node); 
}

function callApi(method, url, body, callback){
    let xhr = new XMLHttpRequest();
    xhr.open(method, url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('Authorization', 'Bearer ' + access_token);
    xhr.send(body);
    xhr.onload = callback;
}