const ip_address = '127.0.0.1'
const socket_port = '3000'

var idroom = document.getElementById('idroom').innerText
var iduser = document.getElementById('iduser').innerText
console.log(idroom);
console.log(iduser);
var socket = io.connect('http://127.0.0.1:3000', { query: 'idroom=' + idroom + '&type=player&iduser=' + iduser });

/**socket.emit('playerJoinToRoomPlay', {
    'idroom': idroom,
    'iduser': iduser
});**/

var mytimeout;

function onClickAns(iscorrect, idroom, iduser, idques, idans, value, listAns) {
    //console.log(listAns);
    for (let ans of JSON.parse(listAns)) {
        if (idques + ans.idans == idques + idans) {
            document.getElementById(idques + ans.idans).innerText = 'T chon cai ni';
        }
        document.getElementById(idques + ans.idans).disabled = true;
    }
    var istrue = iscorrect == idans;
    socket.emit('sendToServer', {
        'idroom': idroom,
        'iduser': iduser,
        'idques': idques,
        'idans': idans,
        'value': value,
        'istrue': istrue,
    })

    if (mytimeout != undefined) clearTimeout(mytimeout);
    var number = document.querySelector('.swiper-pagination-current').innerText;
    var total = document.querySelector('.swiper-pagination-total').innerText;

    //if (number < total) nextPage(parseInt(number));
    if (number <= total) showQuestionCorrectview(istrue, parseInt(number), number < total, idroom, iduser);
}

document.getElementById('btn-count-active').click();

function startTimeBar(timeout, numPageCurrent, numPageTotal, idroom, iduser, idques) {
    console.log(numPageCurrent + '/' + numPageTotal + ',time : ' + timeout);
    if (numPageCurrent <= numPageTotal) {
        mytimeout = setTimeout(() => {
            // Neu vo day tuc la da het time de tra loi
            console.log('Het gio, chua tra loi');
            socket.emit('sendToServer', {
                    'idroom': idroom,
                    'iduser': iduser,
                    'idques': idques,
                    'idans': 'null',
                    'value': 'null',
                    'istrue': false,
                })
                //nextPage(numPageCurrent);
            showQuestionCorrectview(false, numPageCurrent, numPageCurrent < numPageTotal, idroom, iduser);
        }, parseInt(timeout) * 1000);
    }
}

function nextPage(number) {
    document.querySelector('.swiper').swiper.slideNext();
    resetTimeBar();
    number += 1;
    document.getElementById('count-' + number).click();
}

function resetTimeBar() {
    const bars = document.querySelectorAll(".round-time-bar");
    bars.forEach((bar) => {
        bar.classList.remove("round-time-bar");
        bar.offsetWidth;
        bar.classList.add("round-time-bar");
    });
}

function resetTimeBarCorrect() {
    const bar = document.getElementById("round-time-bar-correct");
    bar.classList.remove("round-time-bar");
    bar.offsetWidth;
    bar.classList.add("round-time-bar");
}

function movieStatisticalPage(idroom, iduser) {
    window.location.replace('http://127.0.0.1:8000/waitroomfinish/' +
        idroom + '/' + iduser);

}

function showQuestionCorrectview(isTrue, numberNextPage, isnextPage, idroom, iduser) {
    var containerbg = document.getElementById('container-correct-bg');
    var textCorrect = document.getElementById('text-correct');
    containerbg.style.backgroundColor = isTrue ? "#63C370" : "#EB3745";
    textCorrect.innerHTML = isTrue ? "Correct" : "Incorrect";
    var container = document.getElementById('container-correct-question');
    document.body.classList.add('overflow-hidden')
    container.classList.remove('invisible');
    container.classList.add('visible');
    container.classList.add('container-correct-question-animshow');
    resetTimeBarCorrect();
    timeCorrectBgShow = setTimeout(() => {
        onHideContainer();
        if (isnextPage) nextPage(numberNextPage);
        else movieStatisticalPage(idroom, iduser);
    }, 5 * 1000);
}

function onHideContainer() {
    var container = document.getElementById('container-correct-question');
    document.body.classList.remove('overflow-hidden')
    container.classList.remove('visible');
    container.classList.remove('container-correct-question-animshow');
    container.classList.remove('overflow-hidden');
    container.classList.add('invisible');
}