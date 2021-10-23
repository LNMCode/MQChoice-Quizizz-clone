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

module.exports = router