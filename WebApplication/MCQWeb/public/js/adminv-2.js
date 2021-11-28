function onHideContainer() {
    var container = document.getElementById('container-add-room');
    document.body.classList.remove('overflow-hidden')
    container.classList.remove('visible');
    container.classList.remove('container-add-room-animshow');
    container.classList.remove('overflow-hidden');
    container.classList.add('invisible');
}

function onShowContainer() {
    window.scrollTo({ top: 0 });
    var container = document.getElementById('container-add-room');
    document.body.classList.add('overflow-hidden')
    container.classList.remove('invisible');
    container.classList.add('visible');
    container.classList.add('container-add-room-animshow');
}

function deleteRoom(idroom) {
    console.log(idroom);
}

var checkboxes = document.querySelectorAll("input[type=checkbox]");

checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var idroom = this.value;
        if (this.checked) {
            console.log("Checkbox is checked..");
            var theUrl = 'http://127.0.0.1:3000/room/public?public=true&idroom=' + idroom;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("POST", theUrl, false); // false for synchronous request
            xmlHttp.send(null);
            return xmlHttp.responseText;
        } else {
            console.log("Checkbox is unchecked..");
            var theUrl = 'http://127.0.0.1:3000/room/public?public=false&idroom=' + idroom;
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.open("POST", theUrl, false); // false for synchronous request
            xmlHttp.send(null);
            return xmlHttp.responseText;
        }
    })
});