const mongoose = require('mongoose');

const RoomSchema = mongoose.Schema({
    idroom: {
        type: String
    },
    data: [{
        idques: {
            type: String
        },
        valuesques: {
            type: String
        },
        ans: [{
            idans: {
                type: String
            },
            valueans: {
                type: String
            },
            color: {
                type: String
            }
        }],
        correct: {
            type: String
        },
        time: {
            type: String
        }
    }],
    isstart: {
        type: Boolean
    },
    players: [{
        id: {
            type: String
        },
        name: {
            type: String
        },
        play: [{
            idques: {
                type: String
            },
            idans: {
                type: String
            }
        }]
    }],
    imageUrl: {
        type: String
    },
    title: {
        type: String
    },
    ispublic: {
        type: Boolean
    },
    isopen: {
        type: Boolean
    },
    description: {
        type: String
    }
}, { collection: 'room' });

module.exports = mongoose.model('Room', RoomSchema);