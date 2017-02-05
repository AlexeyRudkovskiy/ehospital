System.register(["./application", "./echo", "./ui/sidebar", "./ui/tabs", "./ui/form/helpers", "./ui/header/global-search", "./ui/notifications", "./ui/diff", "./ui/popup/popup", "./ui/steps", "./ui/select", "./select/ajax/department", "./select/ajax/users", "./select/ajax/nomenclatures", "./select/ajax/units", "./select/ajax/procedure", "./select/ajax/contractor", "./select/ajax/set", "./router", "/js/laroute.js"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var application_1, echo_1, sidebar_1, tabs_1, helpers_1, global_search_1, notifications_1, diff_1, popup_1, steps_1, select_1, department_1, users_1, nomenclatures_1, units_1, procedure_1, contractor_1, set_1, router_1, laroute;
    return {
        setters: [
            function (application_1_1) {
                application_1 = application_1_1;
            },
            function (echo_1_1) {
                echo_1 = echo_1_1;
            },
            function (sidebar_1_1) {
                sidebar_1 = sidebar_1_1;
            },
            function (tabs_1_1) {
                tabs_1 = tabs_1_1;
            },
            function (helpers_1_1) {
                helpers_1 = helpers_1_1;
            },
            function (global_search_1_1) {
                global_search_1 = global_search_1_1;
            },
            function (notifications_1_1) {
                notifications_1 = notifications_1_1;
            },
            function (diff_1_1) {
                diff_1 = diff_1_1;
            },
            function (popup_1_1) {
                popup_1 = popup_1_1;
            },
            function (steps_1_1) {
                steps_1 = steps_1_1;
            },
            function (select_1_1) {
                select_1 = select_1_1;
            },
            function (department_1_1) {
                department_1 = department_1_1;
            },
            function (users_1_1) {
                users_1 = users_1_1;
            },
            function (nomenclatures_1_1) {
                nomenclatures_1 = nomenclatures_1_1;
            },
            function (units_1_1) {
                units_1 = units_1_1;
            },
            function (procedure_1_1) {
                procedure_1 = procedure_1_1;
            },
            function (contractor_1_1) {
                contractor_1 = contractor_1_1;
            },
            function (set_1_1) {
                set_1 = set_1_1;
            },
            function (router_1_1) {
                router_1 = router_1_1;
            },
            function (laroute_1) {
                laroute = laroute_1;
            }
        ],
        execute: function () {
            (function () {
                select_1.registerCreateSelectItem('/api/search/department', department_1.default);
                select_1.registerCreateSelectItem('/api/search/users', users_1.default);
                select_1.registerCreateSelectItem('/api/search/nomenclatures', nomenclatures_1.default);
                select_1.registerCreateSelectItem('/api/search/units', units_1.default);
                select_1.registerCreateSelectItem('/api/search/procedures', procedure_1.default);
                select_1.registerCreateSelectItem('/api/search/contractors', contractor_1.default);
                select_1.registerCreateSelectItem(laroute.route('search.sets', { department: 0 }), set_1.default);
                application_1.default
                    .addOnFirstLoadedEvent(echo_1.default.connect.bind(echo_1.default))
                    .addOnLoadEvent(sidebar_1.default)
                    .addOnLoadEvent(select_1.select)
                    .addOnLoadEvent(tabs_1.default)
                    .addOnLoadEvent(helpers_1.default)
                    .addOnLoadEvent(global_search_1.default)
                    .addOnLoadEvent(diff_1.default)
                    .addOnLoadEvent(steps_1.default)
                    .addOnLoadEvent(router_1.default);
                application_1.default.addEmmitable('select', select_1.select);
                var fixLoading = [
                    popup_1.default, notifications_1.default
                ];
                // const a = new Popup('/_form.json', 'Регистрация', 'Регистрация нового пациента');
                // a.jsonContentBuilder = new SimpleJSONContentBuilder();
                // a.isForm = true;
                // a.create();
                // a.show();
                application_1.default.callOnLoadedEvents();
            })();
        }
    };
});

//# sourceMappingURL=app.js.map
