/// <references path="../../typings/index.d.ts" />

import * as Vue from 'vue'
import { router } from './routes'
import { get, set } from './helpers'
import { tabs } from './tabs'
import { initRevisions } from './revisions'

import { Balance } from './components/medicament/balance'
import { BatchesList } from './components/medicament/batches-list'
import { NotificationsList } from './components/notifications/notifications-list'
import { Discussions } from './components/patient/discussions'

(function () {

    var routes = router();

    tabs();
    initRevisions();

    var page = get(window, 'page');
    var prefix = get(window, 'prefix');

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

    var app = new Vue(<any>{
        el: () => 'body',
        components: [
            Balance,
            BatchesList,
            NotificationsList,
            Discussions
        ]
    });

})();
