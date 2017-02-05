System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var OffscreenViewTestZone;
    return {
        setters: [],
        execute: function () {
            OffscreenViewTestZone = (function () {
                function OffscreenViewTestZone(selector) {
                    this.selector = selector;
                    this.element = null;
                    this.element = document.querySelector(selector);
                }
                OffscreenViewTestZone.prototype.clear = function () {
                    while (this.element.firstElementChild) {
                        this.element.removeChild(this.element.firstElementChild);
                    }
                };
                OffscreenViewTestZone.prototype.test = function (element) {
                    var cloned = element.cloneNode(true);
                    this.element.appendChild(cloned);
                    return cloned;
                };
                OffscreenViewTestZone.prototype.get = function () {
                    return this.element;
                };
                return OffscreenViewTestZone;
            }());
            exports_1("default", OffscreenViewTestZone);
        }
    };
});

//# sourceMappingURL=offscreen-view-test-zone.js.map
