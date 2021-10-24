const socket = require('socket.io');
const mongoose = require('mongoose');
require('dotenv/config')

const XMLHttpRequest = require('xmlhttprequest').XMLHttpRequest;

const express = require('express')
const app = express()
app.set('port', process.env.PORT || 3000);

const http = require('http')
const server = http.createServer(app).listen(app.get('port'), () => {
    console.log("Express server listening on port " + app.get('port'));
})

const io = require('socket.io')(server, {
    cors: { origin: "*"}
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

app.get('/', (req, res) =>{
    res.send('This is home')
});

mongoose.connect(process.env.DB_CONNECTION, { useNewUrlParser: true }, () => {
    console.log('Connected database mongodb');
})

io.on('connection', (socket) => {
    console.log('Have user connected ' + socket.handshake.query.type);

    // Player enjoy into a room
    var idroom = socket.handshake.query.idroom;
    var typeJoin = socket.handshake.query.type;
    var idplayer = socket.handshake.query.iduser;
    console.log('--------------------------');
    console.log(idroom);
    console.log(typeJoin);
    console.log(idplayer);
    if (typeJoin == 'player'){
        console.log('Have player enjoy: ' + idroom);
        io.sockets.emit('playerJoinRoom' + idroom, {idroom: idroom, typejoin: typeJoin, iduser: idplayer});
    }

    // Host start a room
    socket.on('hostStartRoom', (data) => {
        io.sockets.emit('waitStartRoom', 'id123456');
    });

    // Send answer from player in room
    socket.on('sendToServer', data => {
        console.log(socket.id);
        console.log(data);
        sendAnswerToServer("POST", "answer", data);
    });

    //Disconnect socket
    socket.on('disconnect', (socket) => {
        console.log('Disconnection');
    })
})

function sendAnswerToServer(method, url, data){
    const promise = new Promise((resolve, reject) => {
        var xmlhttp = new XMLHttpRequest();   // new HttpRequest instance 
        var theUrl = "http://127.0.0.1:3000/" + url;
        xmlhttp.open(method, theUrl);
        xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xmlhttp.send(JSON.stringify(data));
    })
    return promise;
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