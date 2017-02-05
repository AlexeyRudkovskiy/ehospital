System.register(["whatwg-fetch"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var API;
    return {
        setters: [
            function (_1) {
            }
        ],
        execute: function () {
            API = (function () {
                function API() {
                }
                API.get = function (url) {
                    return window.fetch(url, {
                        headers: {
                            'x-token': window.token
                        },
                        credentials: 'same-origin'
                    });
                };
                API.post = function (url, data) {
                    return fetch(url, {
                        method: 'post',
                        headers: {
                            'x-token': window.token,
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    });
                };
                API.delete = function () {
                };
                API.put = function () {
                };
                return API;
            }());
            exports_1("default", API);
        }
    };
});

//# sourceMappingURL=api.js.map
