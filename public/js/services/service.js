System.register(['./observable'], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var observable_1;
    var Service;
    return {
        setters:[
            function (observable_1_1) {
                observable_1 = observable_1_1;
            }],
        execute: function() {
            Service = (function () {
                function Service() {
                    this.listeners = {};
                }
                Service.prototype.on = function (name) {
                    var observable = new observable_1.Observable();
                    if (typeof this.listeners[name] !== "undefined") {
                        this.listeners[name].push(observable);
                    }
                    else {
                        this.listeners[name] = [observable];
                    }
                    return observable;
                };
                Service.prototype.emit = function (name, data) {
                    if (typeof this.listeners[name] !== "undefined") {
                        for (var i = 0, length = this.listeners[name].length; i < length; i++) {
                            this.listeners[name][i].update(data);
                        }
                    }
                    for (var key in this.listeners) {
                        if (this.match((key), name) && typeof this.listeners[key] !== "undefined") {
                            for (var j = 0, length = this.listeners[key].length; j < length; j++) {
                                this.listeners[key][j].update(data);
                            }
                        }
                    }
                };
                Service.prototype.match = function (pattern, value) {
                    pattern = pattern.replace('*', '([0-1a-zA-Z]+)');
                    pattern = pattern.replace('[0-9]', '([0-1]+)');
                    pattern = pattern.replace('[a-z]', '([a-zA-Z]+)');
                    pattern += '$';
                    return (new RegExp(pattern)).test(value);
                };
                return Service;
            }());
            exports_1("Service", Service);
        }
    }
});

//# sourceMappingURL=service.js.map
