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

    if (number < total) nextPage(parseInt(number));
}

document.getElementById('btn-count-active').click();

function startTimeBar(timeout, numPageCurrent, numPageTotal, idroom, iduser, idques) {
    console.log(numPageCurrent + '/' + numPageTotal + ',time : ' + timeout);
    if (numPageCurrent < numPageTotal) {
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
            nextPage(numPageCurrent);
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

function movieStatisticalPage() {
    // When player finish all questions then movie to Statistical page

}