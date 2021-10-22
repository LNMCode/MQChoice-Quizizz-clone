const ip_address = '127.0.0.1'
const socket_port = '3000'
var socket = io.connect('http://127.0.0.1:3000')

function onStartRoom(data){
    console.log(data);
    socket.emit(
        'hostStartRoom', 
        {
            idroom: data.value,
        }
    )
}