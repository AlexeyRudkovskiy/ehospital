System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function onDiffHeaderClicked() {
        this.parentElement.classList.toggle('active');
    }
    function createDiffs() {
        var diffs = document.querySelectorAll('.diff');
        for (var i = 0; i < diffs.length; i++) {
            var diffHeader = diffs[i].querySelector('.diff-header');
            diffHeader.removeEventListener('click', onDiffHeaderClicked);
            diffHeader.addEventListener('click', onDiffHeaderClicked);
        }
    }
    exports_1("default", createDiffs);
    return {
        setters: [],
        execute: function () {
        }
    };
});

//# sourceMappingURL=diff.js.map
