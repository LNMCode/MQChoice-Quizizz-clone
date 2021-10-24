const ip_address = '127.0.0.1'
const socket_port = '3000'

var idroom = document.getElementById('idroom').innerText
var iduser = document.getElementById('iduser').innerText
console.log(idroom);
console.log(iduser);
var socket = io.connect('http://127.0.0.1:3000', {query:'idroom='+idroom+'&type=player&iduser='+iduser});
socket.on('waitStartRoom', (idroom) => {
    console.log('start room');
    window.location.replace('http://127.0.0.1:8000/users/joinroom/start?idroom='+idroom);
});

function onClickAns(idroom, iduser, idques, idans, value){
    socket.emit(
        'sendToServer', 
        {  
            'idroom': idroom,
            'iduser': iduser,
            'idques': idques,
            'idans': idans,
            'value': value,
        }
    )
}