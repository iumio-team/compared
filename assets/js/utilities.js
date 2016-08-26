var uri = '';
function imageExists(url, callback) {
    var img = new Image();
    img.onload = function() {callback(true); };
    img.onerror = function() {callback(false); };
    img.src = url;
}

function tresponse(imageUrl, imageUrl2, cible) {
    imageExists(imageUrl, function (exists) {
        if (exists == false) {
            imageUrl = imageUrl2;
        }
        document.getElementById(cible).innerHTML = '<img class="img-responsive img-pc center-block" src="'+imageUrl+'">'
    });
}

