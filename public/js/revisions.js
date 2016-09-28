"use strict";
function onRevisionItemClicked() {
    this.classList.toggle('active');
}
function initRevisions() {
    var revisions = document.querySelectorAll('.revision-item');
    for (var i = 0; i < revisions.length; i++) {
        revisions[i].addEventListener('click', onRevisionItemClicked);
    }
}
exports.initRevisions = initRevisions;

//# sourceMappingURL=revisions.js.map
