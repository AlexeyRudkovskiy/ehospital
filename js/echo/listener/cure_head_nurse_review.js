System.register(["../../ui/notifications", "../../lang", "/js/laroute.js"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function default_1(event) {
        var builder = new notifications_1.NotificationBuilder();
        builder
            .setText(lang_1.default.get('notification.cure.need_review'))
            .addAction()
            .setText(lang_1.default.get('notification.cure.action.open'))
            .setUrl(laroute_js_1.default.route('cure.show', { cure: event.cure.id }))
            .stop()
            .notify();
    }
    exports_1("default", default_1);
    var notifications_1, lang_1, laroute_js_1;
    return {
        setters: [
            function (notifications_1_1) {
                notifications_1 = notifications_1_1;
            },
            function (lang_1_1) {
                lang_1 = lang_1_1;
            },
            function (laroute_js_1_1) {
                laroute_js_1 = laroute_js_1_1;
            }
        ],
        execute: function () {
        }
    };
});

//# sourceMappingURL=cure_head_nurse_review.js.map
