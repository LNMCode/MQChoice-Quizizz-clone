const express = require('express');
const Question = require('../models/Question');
const Room = require('../models/Room');

const router = express.Router();

router.get('/', async(req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOne({ idroom: $idroom }).then((doc) => {
            console.log(doc);
            if (doc == null) {
                res.json({ message: 'fail', doc: {} });
            } else {
                res.json({ message: 'ok', doc: doc });
            }
        });
    } catch (err) {
        res.json({ message: err });
    }
});

router.get('/getques', async(req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOne({ idroom: $idroom }).then((doc) => {
            console.log(doc);
            if (doc == null) {
                res.json({ message: 'fail', doc: {} });
            } else {
                res.json({ message: 'ok', doc: doc });
            }
        });
    } catch (err) {
        res.json({ message: err });
    }
})

router.put('/addusertoroom', async(req, res) => {
    try {
        var idroom = req.query.idroom;
        var iduser = req.query.iduser;
        var nameuser = req.query.nameuser;
        console.log(idroom + iduser + nameuser);
        const insertuser = { id: iduser, name: nameuser, play: Array() }
        await Room.findOneAndUpdate({ idroom: idroom }, { $push: { players: insertuser } });
        res.json({ message: 'ok' });
    } catch (err) {
        res.json({ message: err });
    }
});

module.exports = router