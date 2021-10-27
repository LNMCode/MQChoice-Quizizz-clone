const express = require('express');
const Question = require('../models/Question');
const Room = require('../models/Room');
const Users = require('../models/Users');

const router = express.Router();

router.post('/getroombyid', async (req, res) => {
    try {
        console.log(req.query.idroom);
        console.log(req.query.iduser);
        $iduser = req.query.iduser;
        await Users.findOne({id: $iduser}).then((user) => {
            console.log('Find user: ' + user);
            if(user == null) {
                return res.json({message: 'fail', doc: {}})
            }
            console.log(user.rooms);
        });
        $idroom = req.query.idroom;
        await Room.findOne({idroom: $idroom}).then((doc) => {
            console.log(doc);
            if(doc == null){
                res.json({message: 'fail', doc: {}});
            } else {
                res.json({message: 'ok', doc: doc});
            }
        });
    } catch (error) {
        res.json({message: error});
    }
});

router.post('/openroom', async (req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOneAndUpdate({idroom: $idroom}, {isopen: true}).then((doc) => {
            console.log(doc);
            if(doc == null){
                res.json({message: 'fail', doc: {}});
            } else {
                res.json({message: 'ok', doc: doc});
            }
        });
    } catch (error) {
        res.json({message: error});
    }
})

router.post('/closeroom', async (req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOneAndUpdate({idroom: $idroom}, {isopen: false}).then((doc) => {
            console.log(doc);
            if(doc == null){
                res.json({message: 'fail', doc: {}});
            } else {
                res.json({message: 'ok', doc: doc});
            }
        });
    } catch (error) {
        res.json({message: error});
    }
})

router.post('/startroom', async (req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOneAndUpdate({idroom: $idroom}, {isstart: true}).then((doc) => {
            console.log(doc);
            if(doc == null){
                res.json({message: 'fail', doc: {}});
            } else {
                res.json({message: 'ok', doc: doc});
            }
        });
    } catch (err) {
        res.json({message: err});
    }
})

router.get('/getidsusersocket', async (req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOneAndUpdate({idroom: $idroom}, {isstart: true}).then((doc) => {
            console.log(doc);
            if(doc == null){
                res.json({message: 'fail', doc: {}});
            } else {
                res.json({message: 'ok', doc: doc});
            }
        });
    } catch (error) {
        res.json({message: err});
    }
})

module.exports = router