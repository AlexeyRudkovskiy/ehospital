System.register(["../../ui/notifications"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function default_1(event) {
        console.log(event);
        var builder = new notifications_1.NotificationBuilder();
        builder
            .setText('Test notification for ' + event.user.firstName)
            .setType('success').notify();
    }
    exports_1("default", default_1);
    var notifications_1;
    return {
        setters: [
            function (notifications_1_1) {
                notifications_1 = notifications_1_1;
            }
        ],
        execute: function () {
        }
    };
});

//# sourceMappingURL=test_event.js.map
