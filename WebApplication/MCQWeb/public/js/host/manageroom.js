function addNewQuestion() {
    var container = document.getElementById('containerplayerslist');

}

function onHideContainer() {
    var container = document.getElementById('container-add-question');
    document.body.classList.remove('overflow-hidden')
    container.classList.remove('visible');
    container.classList.remove('container-add-question-animshow');
    container.classList.remove('overflow-hidden');
    container.classList.add('invisible');
}

function onShowContainer() {
    window.scrollTo({ top: 0 });
    var container = document.getElementById('container-add-question');
    document.body.classList.add('overflow-hidden')
    container.classList.remove('invisible');
    container.classList.add('visible');
    container.classList.add('container-add-question-animshow');
}