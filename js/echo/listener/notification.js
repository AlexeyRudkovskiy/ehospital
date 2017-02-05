System.register(["../../ui/notifications"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function default_1(event) {
        // let notification = event.data;
        console.log(event);
        var builder = new notifications_1.NotificationBuilder();
        builder
            .setText(event.text)
            .setType(event.type);
        for (var i = 0; i < event.actions.length; i++) {
            builder
                .addAction()
                .setText(event.actions[i].text)
                .setUrl(event.actions[i].action);
        }
        builder
            .notify();
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

//# sourceMappingURL=notification.js.map
