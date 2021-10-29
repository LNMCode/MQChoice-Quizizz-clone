const express = require('express');
const Question = require('../models/Question');
const Room = require('../models/Room');
const Users = require('../models/Users');
const { route } = require('./joinroom');

const router = express.Router();

router.post('/getroombyid', async(req, res) => {
    try {
        console.log(req.query.idroom);
        console.log(req.query.iduser);
        $iduser = req.query.iduser;
        await Users.findOne({ id: $iduser }).then((user) => {
            console.log('Find user: ' + user);
            if (user == null) {
                return res.json({ message: 'fail', doc: {} })
            }
            console.log(user.rooms);
        });
        $idroom = req.query.idroom;
        await Room.findOne({ idroom: $idroom }).then((doc) => {
            console.log(doc);
            if (doc == null) {
                res.json({ message: 'fail', doc: {} });
            } else {
                res.json({ message: 'ok', doc: doc });
            }
        });
    } catch (error) {
        res.json({ message: error });
    }
});

router.post('/openroom', async(req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOneAndUpdate({ idroom: $idroom }, { isopen: true }).then((doc) => {
            console.log(doc);
            if (doc == null) {
                res.json({ message: 'fail', doc: {} });
            } else {
                res.json({ message: 'ok', doc: doc });
            }
        });
    } catch (error) {
        res.json({ message: error });
    }
})

router.post('/closeroom', async(req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOneAndUpdate({ idroom: $idroom }, { isopen: false }).then((doc) => {
            console.log(doc);
            if (doc == null) {
                res.json({ message: 'fail', doc: {} });
            } else {
                res.json({ message: 'ok', doc: doc });
            }
        });
    } catch (error) {
        res.json({ message: error });
    }
})

router.post('/startroom', async(req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOneAndUpdate({ idroom: $idroom }, { isstart: true }).then((doc) => {
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

router.get('/getidsusersocket', async(req, res) => {
    try {
        console.log(req.query.idroom);
        $idroom = req.query.idroom;
        await Room.findOneAndUpdate({ idroom: $idroom }, { isstart: true }).then((doc) => {
            console.log(doc);
            if (doc == null) {
                res.json({ message: 'fail', doc: {} });
            } else {
                res.json({ message: 'ok', doc: doc });
            }
        });
    } catch (error) {
        res.json({ message: err });
    }
})

router.get('/addquestion', async(req, res) => {
    try {
        console.log(req.query);
        var idroom = req.query.idroom;
        var titleques = req.query.titlequestion;
        var valueans1 = req.query.valueans1;
        var valueans2 = req.query.valueans2;
        var valueans3 = req.query.valueans3;
        var valueans4 = req.query.valueans4;
        var correct = req.query.answer;
        var index = req.query.index;
        const insertquestion = {
            idques: 'idq' + Date.now(),
            valuesques: titleques,
            correct: correct,
            time: "30",
            index: index,
            ans: [{
                    idans: 'ans1',
                    valueans: valueans1,
                    color: correct === 'ans1' ? 'green' : 'red'
                },
                {
                    idans: 'ans2',
                    valueans: valueans2,
                    color: correct === 'ans2' ? 'green' : 'red'
                },
                {
                    idans: 'ans3',
                    valueans: valueans3,
                    color: correct === 'ans3' ? 'green' : 'red'
                },
                {
                    idans: 'ans4',
                    valueans: valueans4,
                    color: correct === 'ans4' ? 'green' : 'red'
                }
            ]
        }
        await Room.findOneAndUpdate({ idroom: idroom }, { $push: { data: insertquestion } });
        res.writeHead(302, {
            'Location': 'http://localhost:8000/manageroom/' + idroom
        });
        res.end();
    } catch (error) {
        res.json({ message: err });
    }
})

router.post('/updatequestion', async(req, res) => {

})

router.post('/delquestion', async(req, res) => {

})

router.post('/updateroom', async(req, res) => {
    // Update room this function
    // Only update name and description
})

module.exports = router