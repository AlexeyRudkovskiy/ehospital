System.register([], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var Observable;
    return {
        setters:[],
        execute: function() {
            Observable = (function () {
                function Observable(data) {
                    this.data = null;
                    this.callback = null;
                    this.next = null;
                    this.data = data;
                }
                Observable.prototype.then = function (func) {
                    this.callback = func;
                    this.next = new Observable(this.callback.call(window, this.data));
                    return this.next;
                };
                Observable.prototype.update = function (data) {
                    this.data = data;
                };
                return Observable;
            }());
            exports_1("Observable", Observable);
        }
    }
});

//# sourceMappingURL=service-message.js.map
