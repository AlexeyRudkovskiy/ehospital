function onDiffItemClicked () {
    this.classList.toggle('active');
}

export function initDiffs () {
    var revisions = document.querySelectorAll('.diff');
    for (var i = 0; i < revisions.length; i++) {
        revisions[i].addEventListener('click', onDiffItemClicked);
    }
}
