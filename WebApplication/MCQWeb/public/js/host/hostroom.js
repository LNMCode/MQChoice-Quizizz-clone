const ip_address = '127.0.0.1'
const socket_port = '3000'

var idroom = document.getElementById('idroom').innerText
var iduser = document.getElementById('iduser').innerText
var socket = io.connect('http://127.0.0.1:3000', {query: 'idroom='+idroom+'&type=host&iduser='+iduser});

console.log(idroom);
console.log(iduser);
console.log('Host ' + idroom);
socket.on('playerJoinRoomid123456' , (data) => {
    console.log(data.iduser);
    var container = document.getElementById('containerplayerslist');
    var lineUser = document.createElement('p');
    lineUser.innerText = data.iduser;
    container.appendChild(lineUser);
});

function onStartRoom(data){
    var answer = window.confirm("Are you sure start?");
    if (answer) {
        console.log('Ok t dong nha');
        console.log(data);
        socket.emit('hostStartRoom', {idroom: data.value});
    }
    else {
        console.log('Huy start');
    }
}

function onCloseRoom(data){
    var answer = window.confirm("The room is having some players! Are you sure close?");
    if (answer) {
        console.log('Close room and user be pushed out');
        console.log('Ok t dong nha');
        closeRoom(data);
        window.onbeforeunload = false;
        window.location.replace('http://localhost:8000/manageroom/id123456');
    }
    else {
        console.log('Huy dong');
    }
}

window.onbeforeunload = function (e) {
    console.log('Truoc khi unload');
    return 'Sure?'
};

window.onunload = function(e){
    // Close room and remove all result of users in room
    console.log('No load luon ne');
}

function closeRoom(data)
{
    var theUrl = 'http://127.0.0.1:3000/room/closeroom?idroom=' + data.value;
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "POST", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}

function listPlayersEnjoy(){

}