System.register(["./patient/hospitalization", "./nomenclature/income", "./nomenclature/nomenclature_set/form"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var hospitalization_1, income_1, form_1;
    return {
        setters: [
            function (hospitalization_1_1) {
                hospitalization_1 = hospitalization_1_1;
            },
            function (income_1_1) {
                income_1 = income_1_1;
            },
            function (form_1_1) {
                form_1 = form_1_1;
            }
        ],
        execute: function () {
            exports_1("default", {
                'patient.show': [
                    hospitalization_1.default
                ],
                'cure.show': [
                    hospitalization_1.default
                ],
                'nomenclatureIncome.index': [
                    income_1.default
                ],
                'department.nomenclature_set.item.edit': [
                    form_1.default
                ],
                'department.nomenclature_set.item.create': [
                    form_1.default
                ]
            });
        }
    };
});

//# sourceMappingURL=routes.js.map
