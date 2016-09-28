"use strict";
var observable_1 = require('./observable');
var Service = (function () {
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
exports.Service = Service;

//# sourceMappingURL=service.js.map
