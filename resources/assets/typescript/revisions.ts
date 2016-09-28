function onRevisionItemClicked () {
    this.classList.toggle('active');
}

export function initRevisions () {
    var revisions = document.querySelectorAll('.revision-item');
    for (var i = 0; i < revisions.length; i++) {
        revisions[i].addEventListener('click', onRevisionItemClicked);
    }
}
