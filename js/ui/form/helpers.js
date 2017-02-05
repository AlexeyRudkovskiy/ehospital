System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function keepFocused() {
        var items = document.querySelectorAll('[data-input-keep-focused]');
        for (var i = 0; i < items.length; i++) {
            items.item(i).addEventListener('input', function () {
                this.value ? this.classList.add('active') : this.classList.remove('active');
            });
        }
    }
    exports_1("default", keepFocused);
    return {
        setters: [],
        execute: function () {
        }
    };
});

//# sourceMappingURL=helpers.js.map
