System.register(["./pages/routes"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function router() {
        var currentRoute = window.currentPage;
        for (var key in routes_1.default) {
            if (key === currentRoute) {
                for (var j = 0; j < routes_1.default[key].length; j++) {
                    routes_1.default[key][j].call(window);
                }
                break;
            }
        }
    }
    exports_1("default", router);
    var routes_1;
    return {
        setters: [
            function (routes_1_1) {
                routes_1 = routes_1_1;
            }
        ],
        execute: function () {
        }
    };
});

//# sourceMappingURL=router.js.map
