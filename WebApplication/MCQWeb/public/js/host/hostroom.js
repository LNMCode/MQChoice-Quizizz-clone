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

window.onbeforeunload = function (e) {
    console.log('Truoc khi unload');
    return 'Sure?'
};

window.onunload = function(e){
    // Close room and remove all result of users in room
    console.log('No load luon ne');
}