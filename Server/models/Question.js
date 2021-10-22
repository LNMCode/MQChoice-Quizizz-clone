const mongoose = require('mongoose');

const QuestionSchema = mongoose.Schema({
    title: {
        type: String,
    },
    description: {
        value: String,
    }
});

module.exports = mongoose.model('Question', QuestionSchema);