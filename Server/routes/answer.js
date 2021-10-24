const express = require('express');
const Room = require('../models/Room');
const { route } = require('./joinroom');

const router = express.Router();

router.post('/', async(req, res) => {
    console.log('From API Answer');
    console.log(req.body);
});
module.exports = router