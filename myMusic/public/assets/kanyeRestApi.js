window.onload = function() {
    fetch('https://api.kanye.rest')
    .then(response => response.json())
    .then(data => showData(data));
   
};


var textboxkanyeQuote = document.getElementById("kanyeQuote");

function showData(data){
    textboxkanyeQuote.innerHTML = data.quote;
}