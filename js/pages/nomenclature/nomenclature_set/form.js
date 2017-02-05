System.register(["../../../ui/select"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function default_1() {
        var nomenclatureSelect = select_1.findSelectById('nomenclature_id');
        var unitSelect = select_1.findSelectById('unit_id');
        nomenclatureSelect.addOnChangeEventListener(function (nomenclature) {
            unitSelect.processItems(nomenclature.metadata.units);
            unitSelect.setPlaceholderText();
        });
    }
    exports_1("default", default_1);
    var select_1;
    return {
        setters: [
            function (select_1_1) {
                select_1 = select_1_1;
            }
        ],
        execute: function () {
        }
    };
});

//# sourceMappingURL=form.js.map
