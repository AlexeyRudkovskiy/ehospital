System.register(["./listener/test_event", "./listener/cure_head_nurse_review", "./listener/cure_chief_review", "./listener/notification"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var test_event_1, cure_head_nurse_review_1, cure_chief_review_1, notification_1;
    return {
        setters: [
            function (test_event_1_1) {
                test_event_1 = test_event_1_1;
            },
            function (cure_head_nurse_review_1_1) {
                cure_head_nurse_review_1 = cure_head_nurse_review_1_1;
            },
            function (cure_chief_review_1_1) {
                cure_chief_review_1 = cure_chief_review_1_1;
            },
            function (notification_1_1) {
                notification_1 = notification_1_1;
            }
        ],
        execute: function () {
            exports_1("default", {
                "App\\Events\\TestEvent": [
                    test_event_1.default
                ],
                "App\\Events\\Patient\\CureHeadNurseReview": [
                    cure_head_nurse_review_1.default
                ],
                'App\\Events\\Patient\\CureChiefReview': [
                    cure_chief_review_1.default
                ],
                'App\\Events\\Notification': [
                    notification_1.default
                ]
            });
        }
    };
});

//# sourceMappingURL=routes.js.map
