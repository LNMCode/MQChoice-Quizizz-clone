const express = require('express');
const Question = require('../models/Question');
const Room = require('../models/Room');
const Users = require('../models/Users');
const { route } = require('./joinroom');
var fs = require('fs');
var parse = require('csv-parse');

const router = express.Router();

router.get('/getallroom', async(req, res) => {
    try {
        await Room.find({}).then((doc) => {
            if (doc == null) {
                res.json({ message: 'fail', doc: {} });
            } else {
                res.json({ message: 'ok', doc: doc });
            }
        })
    } catch (error) {
        res.json({ message: error });

    }
});

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
        });
        $idroom = req.query.idroom;
        await Room.findOne({ idroom: $idroom }).then((doc) => {
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
        var timequestion = req.query.timequestion;
        var correct = req.query.answer;
        var index = req.query.index;
        const insertquestion = {
            idques: 'idq' + Date.now(),
            valuesques: titleques,
            correct: correct,
            time: timequestion == undefined ? "30" : timequestion,
            index: index,
            ans: [{
                    idans: 'ans1',
                    valueans: valueans1,
                    colorv2: 'primary',
                    color: correct === 'ans1' ? 'green' : 'red',
                },
                {
                    idans: 'ans2',
                    valueans: valueans2,
                    colorv2: 'info',
                    color: correct === 'ans2' ? 'green' : 'red',
                },
                {
                    idans: 'ans3',
                    valueans: valueans3,
                    colorv2: 'warning',
                    color: correct === 'ans3' ? 'green' : 'red',
                },
                {
                    idans: 'ans4',
                    valueans: valueans4,
                    colorv2: 'danger',
                    color: correct === 'ans4' ? 'green' : 'red',
                }
            ]
        }
        await Room.findOneAndUpdate({ idroom: idroom }, { $push: { data: insertquestion } });
        res.writeHead(302, {
            'Location': 'http://localhost:8000/manageroom/' + idroom
        });
        res.end();
    } catch (err) {
        res.json({ message: err });
    }
})

router.post('/addquestionbycsv', async(req, res) => {
    try {
        var contents = req.body;
        console.log(contents);
        var result = [];
        for (var k in contents) {
            result.push(contents[k]);
        }
        var index = result.pop();
        var idroom = result.pop();
        console.log('idroom' + idroom);
        console.log('index' + index);
        console.log('result' + result);
        for (const item of result) {
            console.log(item);
            var value = item.split(',');
            var indexhaha = parseInt(index) + parseInt(value[0]);
            var lastIndex = indexhaha.toString();
            var titleques = value[1];
            var valueans1 = value[2];
            var valueans2 = value[3];
            var valueans3 = value[4];
            var valueans4 = value[5];
            var correct = 'ans' + value[6];
            var timequestion = value[7];
            const insertquestion = {
                idques: 'idq' + Date.now(),
                valuesques: titleques,
                correct: correct,
                time: timequestion == undefined ? "30" : timequestion,
                index: lastIndex,
                ans: [{
                        idans: 'ans1',
                        valueans: valueans1,
                        colorv2: 'primary',
                        color: correct === 'ans1' ? 'green' : 'red',
                    },
                    {
                        idans: 'ans2',
                        valueans: valueans2,
                        colorv2: 'info',
                        color: correct === 'ans2' ? 'green' : 'red',
                    },
                    {
                        idans: 'ans3',
                        valueans: valueans3,
                        colorv2: 'warning',
                        color: correct === 'ans3' ? 'green' : 'red',
                    },
                    {
                        idans: 'ans4',
                        valueans: valueans4,
                        colorv2: 'danger',
                        color: correct === 'ans4' ? 'green' : 'red',
                    }
                ]
            }
            await Room.findOneAndUpdate({ idroom: idroom }, { $push: { data: insertquestion } });
        }
        res.status(200).send({ message: "ok" });
    } catch (err) {
        console.log(err);
        res.json({ message: err });
    }
})

router.get('/updatequestion', async(req, res) => {
    try {
        console.log(req.query);
        var titlequestion = req.query.titlequestion;
        var ans1 = req.query.ans1;
        var ans2 = req.query.ans2;
        var ans3 = req.query.ans3;
        var ans4 = req.query.ans4;
        var answer = req.query.answer;
        var idroom = req.query.idroom;
        var idques = req.query.idques;
        var timequestion = req.query.timequestion;

        await Room.findOneAndUpdate({ idroom: idroom }, {
            $set: {
                'data.$[inner].valuesques': titlequestion,
                'data.$[inner].correct': answer,
                'data.$[inner].time': timequestion,
                'data.$[inner].ans': [{
                        idans: 'ans1',
                        valueans: ans1,
                        color: answer === 'ans1' ? 'green' : 'red',
                        colorv2: 'primary'
                    },
                    {
                        idans: 'ans2',
                        valueans: ans2,
                        color: answer === 'ans2' ? 'green' : 'red',
                        colorv2: 'info'
                    },
                    {
                        idans: 'ans3',
                        valueans: ans3,
                        color: answer === 'ans3' ? 'green' : 'red',
                        colorv2: 'warning'
                    },
                    {
                        idans: 'ans4',
                        valueans: ans4,
                        color: answer === 'ans4' ? 'green' : 'red',
                        colorv2: 'danger'
                    }
                ]
            }
        }, {
            arrayFilters: [{ "inner.idques": idques }],
            new: true
        });
        res.writeHead(302, {
            'Location': 'http://localhost:8000/manageroom/' + idroom
        });
        res.end();
    } catch (err) {
        res.json({ message: err });
    }
})

router.get('/delquestion', async(req, res) => {
    try {
        var idroom = req.query.idroom;
        var idques = req.query.idques;
        console.log(idroom);
        console.log(idques);
        await Room.findOneAndUpdate({ idroom: idroom }, {
            $pull: {
                data: {
                    idques: idques
                }
            }
        })
        res.writeHead(302, {
            'Location': 'http://localhost:8000/manageroom/' + idroom
        });
        res.end();
    } catch (err) {
        res.json({ message: err });
    }
})

router.get('/updateroom', async(req, res) => {
    // Update room this function
    // Only update name and description
    try {
        var idroom = req.query.idroom;
        var title = req.query.nameroom;
        var description = req.query.desriptionroom;
        var image = req.query.imageurl;
        await Room.findOneAndUpdate({ idroom: idroom }, {
            title: title,
            desription: description,
            imageUrl: image
        })
        res.writeHead(302, {
            'Location': 'http://localhost:8000/manageroom/' + idroom
        });
        res.end();
    } catch (error) {
        res.json({ message: error });

    }
})

router.get('/createnewroom', async(req, res) => {
    console.log(req.query);
    try {
        var nameroom = req.query.nameroom;
        var description = req.query.description;
        var iduser = req.query.iduser;
        var idnewroom = Math.floor(Math.random() * (99999999 - 12345678) + 12345678);

        console.log(nameroom);
        console.log(description);

        await Room.create({
            idroom: idnewroom,
            title: nameroom,
            desription: description,
            isstart: false,
            imageUrl: 'null',
            ispublic: true,
            isopen: false
        })
        await Users.findOneAndUpdate({ id: iduser }, {
            $push: {
                rooms: {
                    idroom: idnewroom
                }
            }
        })
        res.writeHead(302, {
            'Location': 'http://localhost:8000/manageroom/' + idnewroom
        });
        res.end();
    } catch (error) {
        console.log({ message: err });
    }
})

router.post('/public', async(req, res) => {
    try {
        var public = req.query.public;
        var idroom = req.query.idroom;
        await Room.findOneAndUpdate({ idroom: idroom }, { ispublic: public }).then((doc) => {
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

router.post('/removeallplayer', async(req, res) => {
    try {
        var idroom = req.query.idroom;
        await Room.findOneAndUpdate({ idroom: idroom }, {
            players: [],
        })
        res.json({ message: 'ok' });
    } catch (error) {
        res.json({ message: error });
    }
})

module.exports = router