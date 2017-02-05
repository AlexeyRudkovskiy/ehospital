System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function default_1(procedure) {
        return {
            text: procedure.name,
            value: procedure.id,
            isSelected: typeof procedure.selected !== "undefined" ? procedure.selected : false
        };
    }
    exports_1("default", default_1);
    return {
        setters: [],
        execute: function () {
        }
    };
});

//# sourceMappingURL=procedure.js.map
