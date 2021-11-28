const ip_address = '127.0.0.1'
const socket_port = '3000'

var idroom = document.getElementById('idroom').innerHTML
var iduser = document.getElementById('iduser').innerHTML
console.log(idroom);
console.log(iduser);
var socket = io.connect('http://127.0.0.1:3000');

socket.emit('waitFinishRoom', {
    'idroom': idroom,
});

socket.on('finishRoomToClient' + idroom, (data) => {
    if (data == idroom) {
        window.location.replace('http://127.0.0.1:8000/summary/' +
            idroom + '/' + iduser)
    }
});