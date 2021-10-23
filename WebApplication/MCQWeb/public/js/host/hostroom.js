const ip_address = '127.0.0.1'
const socket_port = '3000'
var socket = io.connect('http://127.0.0.1:3000')

function onStartRoom(data){
    var answer = window.confirm("Are you sure start?");
    if (answer) {
        console.log('Ok t dong nha');
        console.log(data);
        socket.emit(
            'hostStartRoom', 
            {
                idroom: data.value,
            }
        )
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