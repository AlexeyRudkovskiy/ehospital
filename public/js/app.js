"use strict";
var Vue = require('vue');
var routes_1 = require('./routes');
var helpers_1 = require('./helpers');
var tabs_1 = require('./tabs');
var revisions_1 = require('./revisions');
var BalanceComponent_1 = require('./vue/BalanceComponent');
(function () {
    var routes = routes_1.router();
    tabs_1.tabs();
    revisions_1.initRevisions();
    var page = helpers_1.get(window, 'page');
    var prefix = helpers_1.get(window, 'prefix');
    for (var i = 0; i < routes.length; i++) {
        if (routes[i].prefix === prefix) {
            for (var action in routes[i].actions) {
                if (action === page) {
                    // creating instance
                    var instance = new routes[i].actions[action];
                }
            }
        }
    }
    var app = new Vue({
        el: function () { return 'body'; },
        components: [
            BalanceComponent_1.BalanceComponent
        ]
    });
})();

//# sourceMappingURL=app.js.map
