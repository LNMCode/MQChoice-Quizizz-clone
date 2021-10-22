const mongoose = require('mongoose');

const UserSchema = mongoose.Schema({
    id: {
        type: String
    },
    rooms: [{
        idroom: {
            type: String
        }
    }],
    type: {
        type: String
    },
    password: {
        type: String
    },
    username: {
        type: String
    }
}, {collection: 'users'});

module.exports = mongoose.model('Users', UserSchema);