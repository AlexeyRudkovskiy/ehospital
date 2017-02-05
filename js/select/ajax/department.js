System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function default_1(department) {
        return {
            value: department.id,
            text: department.name,
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

//# sourceMappingURL=department.js.map
