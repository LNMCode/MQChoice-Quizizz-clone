const express = require('express');
const Question = require('../models/Question');
const Room = require('../models/Room');

const router = express.Router();

router.post('/getroombyid', async (req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOne({idroom: $idroom}).then((doc) => {
            console.log(doc);
            res.json(doc);
        });
    } catch (error) {
        res.json({message: error});
    }
});


module.exports = router