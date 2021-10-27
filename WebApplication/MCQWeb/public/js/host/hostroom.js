const ip_address = '127.0.0.1'
const socket_port = '3000'

var idroom = document.getElementById('idroom').innerText
var iduser = document.getElementById('iduser').innerText

var socket = io.connect('http://127.0.0.1:3000', {query: 'idroom='+idroom+'&type=host&iduser='+iduser});

console.log(idroom);
console.log(iduser);
console.log('Host ' + idroom);

socket.emit('hostOpenRoom', {idroom: idroom, iduser: iduser});

socket.on('playerJoinRoom' + idroom, (data) => {
    console.log(data.iduser);
    var container = document.getElementById('containerplayerslist');
    var lineUser = document.createElement('p');
    lineUser.innerText = data.iduser + ' - ' + data.nameuser;
    container.appendChild(lineUser);
});

function onStartRoom(data){
    var answer = window.confirm("Are you sure start?");
    if (answer) {
        console.log('Ok t dong nha');
        console.log(data);
        socket.emit('hostStartRoom', {idroom: data.value});
        // Chuyen qua page chart thống kê (host flow room)
        window.location.replace('http://127.0.0.1:8000/hostflowroom/flowroom?idroom='+idroom+'&iduser='+iduser);
    }
    else {
        console.log('Huy start');
    }
}
function listPlayersEnjoy(){

}