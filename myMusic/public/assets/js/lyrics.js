const ENDPOINT = "/api/censorIt?method="

function callCensorService(text){
    let body = {
        "text": text
    }
    let url = ENDPOINT + "censor";

    callCensorIt(url, body);
};

function callCensorReplaceService( text, replacement ){
    let body = {
        "text": text,
        "replacement": replacement 
    }
    let url = ENDPOINT + "censor_replace";

    callCensorIt(url, body);
};


function callReplaceWordService( text, word, replacement ){
    let body = {
        "text": text,
        "input": word,
        "replacement": replacement 
    }
    let url = ENDPOINT + "replace_word_for_word"

    callCensorIt(url, body);
};

//handler is the function that should handle the responded data
async function callCensorIt(url, body){
    
    var res = await fetch(url, {
        method: "POST",
        headers: {'Content-Type' : 'application/json'},
        body: JSON.stringify(body)
    }).then(response => response.json())
    .then(data => censorItHandler(data.text));
}

function censorItHandler(text){
    document.getElementById("lyricText").innerHTML = text;
}
