/// <references path="../../typings/index.d.ts" />
"use strict";
var Vue = require('vue');
var routes_1 = require('./routes');
var helpers_1 = require('./helpers');
var tabs_1 = require('./tabs');
var revisions_1 = require('./revisions');
var balance_component_1 = require('./components/medicament/balance-component');
var batches_list_component_1 = require('./components/medicament/batches-list-component');
var notifications_list_component_1 = require('./components/notifications/notifications-list-component');
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
            balance_component_1.BalanceComponent,
            batches_list_component_1.BatchesListComponent,
            notifications_list_component_1.NotificationsListComponent
        ]
    });
})();

//# sourceMappingURL=app.js.map
