function onHideContainer() {
    var container = document.getElementById('container-add-room');
    document.body.classList.remove('overflow-hidden')
    container.classList.remove('visible');
    container.classList.remove('container-add-room-animshow');
    container.classList.remove('overflow-hidden');
    container.classList.add('invisible');
}

function onShowContainer() {
    window.scrollTo({ top: 0 });
    var container = document.getElementById('container-add-room');
    document.body.classList.add('overflow-hidden')
    container.classList.remove('invisible');
    container.classList.add('visible');
    container.classList.add('container-add-room-animshow');
}