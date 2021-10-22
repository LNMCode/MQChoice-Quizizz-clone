const socket = require('socket.io');
const mongoose = require('mongoose');
require('dotenv/config')

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


app.get('/', (req, res) =>{
    res.send('This is home')
});

mongoose.connect(process.env.DB_CONNECTION, { useNewUrlParser: true }, () => {
    console.log('Connected database mongodb');
})

io.on('connection', (socket) => {
    console.log('Have user connected');

    socket.on('sendToServer', data => {
        console.log(socket.id);
        console.log(data);
    });

    socket.on('hostStartRoom', (data) => {
        io.sockets.emit('waitStartRoom', 'id123456');
    });

    socket.on('disconnect', (socket) => {
        console.log('Disconnection');
    })
})





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