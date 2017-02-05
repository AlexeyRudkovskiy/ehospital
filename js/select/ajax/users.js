System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function default_1(user) {
        return {
            value: user.id,
            text: user.name,
            isSelected: false,
            element: null
        };
    }
    exports_1("default", default_1);
    return {
        setters: [],
        execute: function () {
        }
    };
});

//# sourceMappingURL=users.js.map
