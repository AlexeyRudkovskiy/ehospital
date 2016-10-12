"use strict";
function onDiffItemClicked() {
    this.classList.toggle('active');
}
function initDiffs() {
    var revisions = document.querySelectorAll('.diff');
    for (var i = 0; i < revisions.length; i++) {
        revisions[i].addEventListener('click', onDiffItemClicked);
    }
}
exports.initDiffs = initDiffs;

//# sourceMappingURL=diffs.js.map
