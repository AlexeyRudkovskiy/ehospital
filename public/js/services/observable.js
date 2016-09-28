"use strict";
var Observable = (function () {
    function Observable(data) {
        this.data = null;
        this.callback = null;
        this.filterFunc = null;
        this.mapFunc = null;
        this.eachFunc = null;
        this.next = null;
        this.queue = [];
        this.data = data;
    }
    Observable.prototype.then = function (func) {
        this.callback = func;
        if (typeof this.data !== "undefined") {
            this.data = this.callback.call(window, this.data);
        }
        this.next = new Observable(this.data);
        this.queue.push('then');
        return this.next;
    };
    Observable.prototype.filter = function (func) {
        if (this.data instanceof Array) {
            this.filterFunc = func;
            this.data = this.data.filter(func);
        }
        this.queue.push('filter');
        return this;
    };
    Observable.prototype.map = function (func) {
        if (this.data instanceof Array) {
            this.mapFunc = func;
            this.data = this.data.map(func);
        }
        this.queue.push('map');
        return this;
    };
    Observable.prototype.each = function (func) {
        if (this.data instanceof Array) {
            this.eachFunc = func;
            this.data.forEach(this.eachFunc);
        }
        this.queue.push('each');
        return this;
    };
    Observable.prototype.update = function (data) {
        if (this.callback != null) {
            this.data = data;
            for (var i = 0, length = this.queue.length; i < length; i++) {
                switch (this.queue[i]) {
                    case 'filter':
                        if (this.filterFunc != null) {
                            this.filter(this.filterFunc);
                        }
                        break;
                    case 'map':
                        if (this.mapFunc != null) {
                            this.map(this.mapFunc);
                        }
                        break;
                    case 'then':
                        if (this.callback != null) {
                            this.data = this.callback.call(window, this.data);
                        }
                        break;
                    case 'each':
                        if (this.eachFunc != null) {
                            this.each(this.eachFunc);
                        }
                        break;
                }
            }
            if (this.next != null) {
                this.next.update(this.data);
            }
        }
    };
    return Observable;
}());
exports.Observable = Observable;

//# sourceMappingURL=observable.js.map
