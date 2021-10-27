const ip_address = '127.0.0.1'
const socket_port = '3000'

var idroom = document.getElementById('idroom').innerText
var iduser = document.getElementById('iduser').innerText
console.log(idroom);
console.log(iduser);
var socket = io.connect('http://127.0.0.1:3000', {query:'idroom='+idroom+'&type=player&iduser='+iduser});

/**socket.emit('playerJoinToRoomPlay', {
    'idroom': idroom,
    'iduser': iduser
});**/

function onClickAns(idroom, iduser, idques, idans, value, listAns){
    console.log(listAns);
    for (let ans of JSON.parse(listAns)){
        if(idques + ans.idans == idques + idans){
            document.getElementById(idques+ans.idans).innerText = 'T chon cai ni';
        }
        document.getElementById(idques+ans.idans).disabled = true;
    }
    socket.emit('sendToServer', {  
            'idroom': idroom,
            'iduser': iduser,
            'idques': idques,
            'idans': idans,
            'value': value,
        }
    )
}