const express = require('express');
const User = require('../models/Users');

const router = express.Router();

router.post('/', async (req, res) => {
    try {
        var username = req.query.username;
        var password = req.query.password;

        console.log('Login ' + username + ' - ' + password);
        await User.findOne({username: username, password: password}).then((user) => {
            console.log(user);
            if(user == null){
                res.json({message: 'fail', doc: {}});
            } else {
                res.json({message: 'ok', doc: user});
            }
        })
    } catch (error) {
        res.json({message: error});
    }
});

module.exports = router