System.register(["./ui/form/elements"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var elements_1, SimpleJSONContentBuilder;
    return {
        setters: [
            function (elements_1_1) {
                elements_1 = elements_1_1;
            }
        ],
        execute: function () {
            SimpleJSONContentBuilder = (function () {
                function SimpleJSONContentBuilder() {
                }
                SimpleJSONContentBuilder.prototype.build = function (data) {
                    var container = document.createElement('form');
                    container.classList.add('form');
                    container.setAttribute('method', data.method);
                    container.setAttribute('action', data.action);
                    for (var i = 0; i < data.items.length; i++) {
                        var item = data.items[i];
                        var element = elements_1.default.text(item.label, item.name, item.value, item.placeholder);
                        container.appendChild(element);
                    }
                    return container;
                };
                return SimpleJSONContentBuilder;
            }());
            exports_1("default", SimpleJSONContentBuilder);
        }
    };
});

//# sourceMappingURL=simpleJSONContentBuilder.js.map
