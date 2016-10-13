"use strict";
var API = (function () {
    function API(_token) {
        this._token = _token;
    }
    API.getInstance = function () {
        if (API.instance === null) {
            API.instance = new API(window.token);
        }
        return API.instance;
    };
    API.get = function (url) {
        return window.fetch(url, {
            headers: {
                'x-token': API.getInstance().token
            }
        });
    };
    API.post = function (url, data) {
        return window.fetch(url, {
            method: 'post',
            headers: {
                'x-token': API.getInstance().token
            },
            body: data
        });
    };
    API.put = function (url, data) {
        return window.fetch(url, {
            method: 'put',
            headers: {
                'x-token': API.getInstance().token
            },
            body: data
        });
    };
    Object.defineProperty(API.prototype, "token", {
        get: function () {
            return this._token;
        },
        enumerable: true,
        configurable: true
    });
    API.instance = null;
    return API;
}());
exports.API = API;

//# sourceMappingURL=api.js.map
