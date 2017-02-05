System.register(["./ui/offscreen-view-test-zone"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var offscreen_view_test_zone_1, Application, app;
    return {
        setters: [
            function (offscreen_view_test_zone_1_1) {
                offscreen_view_test_zone_1 = offscreen_view_test_zone_1_1;
            }
        ],
        execute: function () {
            Application = (function () {
                function Application() {
                    this.loaded = false;
                    this._offscreenViewTestZone = null;
                    this.onLoadedEvents = [];
                    this.onFirstLoadedEvents = [];
                    this.onResizeEvents = [];
                    this.emmitable = {};
                    this._offscreenViewTestZone = new offscreen_view_test_zone_1.default('#offscreen-test-view-zone');
                }
                Application.prototype.addOnLoadEvent = function (callback) {
                    if (typeof callback !== "function") {
                        throw "callback should be closure";
                    }
                    this.onLoadedEvents.push(callback);
                    return this;
                };
                Application.prototype.addOnFirstLoadedEvent = function (callback) {
                    if (typeof callback !== "function") {
                        throw "callback should be closure";
                    }
                    this.onFirstLoadedEvents.push(callback);
                    return this;
                };
                Application.prototype.addOnResizeEvent = function (callback) {
                    if (typeof callback !== "function") {
                        throw "callback should be closure";
                    }
                    this.onResizeEvents.push(callback);
                    return this;
                };
                Application.prototype.addEmmitable = function (key, callback) {
                    if (typeof this.emmitable[key] === "undefined") {
                        this.emmitable[key] = [];
                    }
                    this.emmitable[key].push(callback);
                };
                Application.prototype.callOnLoadedEvents = function () {
                    this.onLoadedEvents.forEach(function (callback) { return callback.apply(window); });
                    if (!this.loaded) {
                        this.onFirstLoadedEvents.forEach(function (callback) { return callback.apply(window); });
                    }
                    this.loaded = true;
                    return this;
                };
                Application.prototype.callOnResizeEvents = function () {
                    this.onResizeEvents.forEach(function (callback) { return callback.apply(window); });
                    return this;
                };
                Application.prototype.callEmmitable = function (key) {
                    if (typeof this.emmitable[key] === "undefined") {
                        throw {
                            message: "Emmitabled callbacks not found",
                            key: key
                        };
                    }
                    this.emmitable[key].forEach(function (callback) { return callback.apply(window); });
                };
                Object.defineProperty(Application.prototype, "offscreenViewTestZone", {
                    get: function () {
                        return this._offscreenViewTestZone;
                    },
                    enumerable: true,
                    configurable: true
                });
                return Application;
            }());
            app = new Application();
            exports_1("default", app);
        }
    };
});

//# sourceMappingURL=application.js.map
