const express = require('express');
const Question = require('../models/Question');
const Room = require('../models/Room');

const router = express.Router();

router.get('/', async (req, res) => {
    /**
     * req.body... : use for json in body or another value in body
     * req.query... : it is like qeury value in url https://kkk.oo?idRoom=id123456
     *let idRoom = 'id123456'
     let idRoomReq = req.query.idRoom
        res.send({'isExist': idRoom == idRoomReq})
    */
    
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOne({idroom: $idroom}).then((doc) => {
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
});

router.get('/getques', async (req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOne({idroom: $idroom}).then((doc) => {
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

router.put('/addusertoroom', async (req, res) => {
    try {
        var idroom = req.query.idroom;
        var iduser = req.query.iduser;
        var nameuser = req.query.nameuser;
        console.log(idroom + iduser + nameuser);
        const insertuser = {id: iduser, name: nameuser, play: Array()}
        await Room.findOneAndUpdate({idroom: idroom}, {$push: {players: insertuser}});
        res.json({message: 'ok'});
    } catch (err) {
        res.json({message: err});
    }
});

/**
// Get back all questions
router.get('/', (req, res) => {
    try {
        const questions = await Question.find();
        res.json(questions);
    } catch (err) {
        res.json({message: err});
    }
});

// Save questions
router.post('/', async (req, res) => {
    const question = new Question({
        title: 'Hahahahaha',
        description: 'DesHahahaha',
    })

    try{
        const quesSave = await question.save();
        res.json(quesSave);
    } catch(err){
        res.json({message: err});
    }
})

// Delete questions
router.delete('/detele', async (req, res) => {
    try {
        const removedQuestion = await Question.findById({_id: req.params.questionId});
        res.json(removedQuestion);   
    } catch (error) {
        res.json({message: err});
    }
})
 */

module.exports = router