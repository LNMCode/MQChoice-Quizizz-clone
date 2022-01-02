const ip_address = '127.0.0.1'
const socket_port = '3000'

var idroom = document.getElementById('idroom').innerHTML
var iduser = document.getElementById('iduser').innerHTML
var numberQuestion = document.getElementById('number-question').innerHTML;

var socket = io.connect('http://127.0.0.1:3000');

console.log(idroom);
console.log(iduser);

socket.emit('hostObserveRoomPlay', {
    'idroom': idroom,
    'iduser': iduser,
});

socket.on('playerAnswered' + idroom, (data) => {
    console.log(data.istrue);
    var mainwidth = document.getElementById('progress-inner').clientWidth;
    if (data.istrue) {
        var correct = document.getElementById('correct-' + data.iduser);
        var correctwidth = correct.clientWidth;
        console.log(correctwidth);
        correct.style.width = (correctwidth + (mainwidth / numberQuestion)) + 'px'
    } else {
        var incorrect = document.getElementById('incorrect-' + data.iduser);
        var incorrectwidth = incorrect.clientWidth;
        console.log(incorrectwidth);
        incorrect.style.width = (incorrectwidth + (mainwidth / numberQuestion)) + 'px'
    }

});

function onCloseRoom(data) {
    var answer = window.confirm("The room is having some players! Are you sure close?");
    if (answer) {
        console.log('Close room and user be pushed out');
        socket.emit('finishRoomFromHost', { idroom: data.value });
        closeRoom(data);
        window.onbeforeunload = false;
        //window.location.replace('http://localhost:8000/admin');
        window.location.replace('http://127.0.0.1:8000/summary/' +
            data.value + '/null')
    } else {
        console.log('Huy dong');
    }
}

window.onbeforeunload = function(e) {
    console.log('Truoc khi unload');
    return 'Sure?'
};

window.onunload = function(e) {
    // Close room and remove all result of users in room
    console.log('No load luon ne');
}

function closeRoom(data) {
    var theUrl = 'http://127.0.0.1:3000/room/closeroom?idroom=' + data.value;
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST", theUrl, false); // false for synchronous request
    xmlHttp.send(null);
    return xmlHttp.responseText;
}