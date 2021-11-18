const socket = require('socket.io');
const mongoose = require('mongoose');
require('dotenv/config')

const XMLHttpRequest = require('xmlhttprequest').XMLHttpRequest;

const express = require('express')
const app = express()
var device = require('express-device')
app.use(device.capture())

app.set('port', process.env.PORT || 3000);

const http = require('http')
const server = http.createServer(app).listen(app.get('port'), () => {
    console.log('Express server listening on ' + ':' + app.get('port'));
})

const io = require('socket.io')(server, {
    cors: { origin: "*" }
});

const cors = require('cors');
app.use(cors());

const bodyParser = require('body-parser');
app.use(bodyParser.json())

// Routers
const joinRoomRouter = require('./routes/joinroom');
app.use('/joinroom', joinRoomRouter);

const loginRouter = require('./routes/login');
app.use('/login', loginRouter);

const roomRouter = require('./routes/room');
app.use('/room', roomRouter);

const answerRouter = require('./routes/answer')
app.use('/answer', answerRouter);

app.get('/', (req, res) => {
    res.send('This is home')
});

mongoose.connect(process.env.DB_CONNECTION, { useNewUrlParser: true }, () => {
    console.log('Connected database mongodb');
})

io.on('connection', (socket) => {
    console.log('Have user connected ' + socket.handshake.query.type);

    // Player enjoy into a room wait
    socket.on('waitRoomSendFromClient', (data) => {
        var idroom = data.idroom;
        var iduser = data.iduser;
        var nameuser = data.nameuser;
        console.log('--------------------------');
        console.log(idroom);
        console.log(nameuser);
        console.log(iduser);

        socket.join(idroom + 'wait')
        socket.to(idroom + 'wait').emit('playerJoinRoom' + idroom, { idroom: idroom, iduser: iduser, nameuser: nameuser });
    });

    // Host open a room wait
    // And join a room wait, same with players
    socket.on('hostOpenRoom', (data) => {
        var idroom = data.idroom;
        var iduser = data.iduser;

        console.log('Host open room ' + idroom);
        socket.join(idroom + 'wait');
    });

    // Host start a room wait
    socket.on('hostStartRoom', (data) => {
        var idroom = data.idroom;

        socket.to(idroom + 'wait').emit('waitStartRoom' + idroom, idroom);
    });

    // Player change from room wait to room play
    socket.on('playerJoinToRoomPlay', (data) => {
        var idroom = data.idroom;
        var iduser = data.iduser;

        socket.join(idroom + 'playroom');
    });

    // Host observe answer of players
    socket.on('hostObserveRoomPlay', (data) => {
        var idroom = data.idroom;

        console.log('Host flow room ' + idroom);
        socket.join(idroom + 'playroom');
    });

    // Send answer from player in room (roomques.js)
    socket.on('sendToServer', data => {
        console.log(socket.id);
        console.log(data);
        var idroom = data.idroom;
        sendAnswerToServer("POST", "answer", data);
        socket.to(idroom + 'playroom').emit('playerAnswered' + idroom, data);
    });

    // Wait finish room from client
    socket.on('waitFinishRoom', (data) => {
        var idroom = data.idroom;
        console.log('Have user finish exam');
        socket.join('waitFinishRoom' + idroom);
    })


    socket.on('finishRoomFromHost', (data) => {
        var idroom = data.idroom
        socket.to('waitFinishRoom' + idroom).emit('finishRoomToClient' + idroom, idroom);
    })

    //Disconnect socket
    socket.on('disconnect', (socket) => {
        console.log('Disconnection');
    })
})

function sendAnswerToServer(method, url, data) {
    const promise = new Promise((resolve, reject) => {
        var xmlhttp = new XMLHttpRequest(); // new HttpRequest instance 
        var theUrl = "http://127.0.0.1:3000/" + url;
        xmlhttp.open(method, theUrl);
        xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xmlhttp.send(JSON.stringify(data));
    })
    return promise;
}

function getIdsUserSocketByIdRoom(method, url, idroom) {

}


// socket.emit chi 1-1
// io.sockets.emit gui toi all
// socket.broadcast.emit gui toi con lai, ngoai tru nguoi send
// io.to('id').emit chi end-to-end

//get query&params in express

//etc. example.com/user/000000?sex=female

/**app.get('/user/:id', function(req, res) {

    const query = req.query;// query = {sex:"female"}
  
    const params = req.params; //params = {id:"000000"}
  
  })
*/