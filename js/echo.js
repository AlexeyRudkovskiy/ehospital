System.register(["./echo/routes"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var routes_1, Echo, echo;
    return {
        setters: [
            function (routes_1_1) {
                routes_1 = routes_1_1;
            }
        ],
        execute: function () {
            Echo = (function () {
                function Echo(config) {
                    if (config === void 0) { config = null; }
                    this.callbacks = {};
                    this.messagesCount = 0;
                    this.config = config || {
                        port: 5888,
                        host: 'localhost'
                    };
                }
                Echo.prototype.connect = function () {
                    this.connection = window.io.connect(this.config.host + ':' + this.config.port);
                    this.connection.on('connect', this.onConnected.bind(this));
                    this.connection.on('message', this.onMessage.bind(this));
                };
                Echo.prototype.onConnected = function () {
                    console.log('Successfully connected to ' + this.config.host + ':' + this.config.port);
                    this.connection.emit('register', {
                        id: window.user.id
                    });
                    console.log('[ECHO] Registered width id ' + window.user.id);
                    this.bootstrap();
                };
                Echo.prototype.onMessage = function (message) {
                    var key = message.channel;
                    var messageContainer = message.message;
                    this.messagesCount++;
                    console.log('[ECHO] New message with local number ' + this.messagesCount, message);
                    try {
                        if (typeof this.callbacks[key] !== "undefined") {
                            console.log("[ECHO] Listeners for message #" + this.messagesCount, this.callbacks[key].length);
                            this.callbacks[key].forEach(function (callback) {
                                callback.call(window, messageContainer.data);
                            });
                        }
                        else {
                            console.log('No any callbacks for channel "', key, '"', messageContainer);
                        }
                    }
                    catch (e) {
                        console.error(e);
                    }
                };
                Echo.prototype.subscribe = function (key, callback) {
                    if (typeof this.callbacks[key] === "undefined") {
                        this.callbacks[key] = [];
                    }
                    this.callbacks[key].push(callback);
                };
                Echo.prototype.bootstrap = function () {
                    for (var event_1 in routes_1.default) {
                        for (var i = 0; i < routes_1.default[event_1].length; i++) {
                            this.subscribe(event_1, routes_1.default[event_1][i]);
                        }
                    }
                };
                return Echo;
            }());
            echo = new Echo();
            exports_1("default", echo);
        }
    };
});

//# sourceMappingURL=echo.js.map
