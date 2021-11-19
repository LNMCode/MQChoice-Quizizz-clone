const express = require('express');
const Room = require('../models/Room');

const router = express.Router();

router.post('/', async(req, res) => {
    console.log('From API Answer');
    console.log(req.body);
    var idroom = req.body.idroom;
    var iduser = req.body.iduser;
    var nameuser = req.body.nameuser;
    var idques = req.body.idques;
    var idans = req.body.idans;
    var value = req.body.value;
    var istrue = req.body.istrue;
    try {
        let result = await Room.findOneAndUpdate({ idroom: idroom }, {
            $push: { 'players.$[inner].play': { idques: idques, idans: idans, istrue: istrue } }
        }, {
            arrayFilters: [{ "inner.id": iduser }],
            new: true
        });

        if (!result) return res.json({ message: 'fail' });
        res.json({ message: 'ok' })
    } catch (error) {
        res.json({ message: err });
    }
});

module.exports = router