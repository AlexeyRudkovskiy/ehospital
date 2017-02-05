System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var HTMLContentBuilder;
    return {
        setters: [],
        execute: function () {
            HTMLContentBuilder = (function () {
                function HTMLContentBuilder() {
                }
                HTMLContentBuilder.prototype.build = function (data) {
                    var element = document.createElement('div');
                    element.innerHTML = data;
                    return element.childElementCount === 1 ? element.firstElementChild : element;
                };
                return HTMLContentBuilder;
            }());
            exports_1("default", HTMLContentBuilder);
        }
    };
});

//# sourceMappingURL=html-content-builder.js.map
