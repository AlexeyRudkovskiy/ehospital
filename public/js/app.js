/// <references path="../../typings/index.d.ts" />
"use strict";
var Vue = require('vue');
var routes_1 = require('./routes');
var helpers_1 = require('./helpers');
var tabs_1 = require('./tabs');
var diffs_1 = require('./diffs');
var balance_1 = require('./components/medicament/balance');
var batches_list_1 = require('./components/medicament/batches-list');
var notifications_list_1 = require('./components/notifications/notifications-list');
var discussions_1 = require('./components/patient/discussions');
(function () {
    var routes = routes_1.router();
    tabs_1.tabs();
    diffs_1.initDiffs();
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
            balance_1.Balance,
            batches_list_1.BatchesList,
            notifications_list_1.NotificationsList,
            discussions_1.Discussions
        ]
    });
})();

//# sourceMappingURL=app.js.map
