System.register(["../../ui/form", "/js/laroute.js", "../../lang", "../../application", "../../ui/select"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var form_1, laroute, lang_1, application_1, select_1, HospitalizationPopupProcedureContentBuilder;
    return {
        setters: [
            function (form_1_1) {
                form_1 = form_1_1;
            },
            function (laroute_1) {
                laroute = laroute_1;
            },
            function (lang_1_1) {
                lang_1 = lang_1_1;
            },
            function (application_1_1) {
                application_1 = application_1_1;
            },
            function (select_1_1) {
                select_1 = select_1_1;
            }
        ],
        execute: function () {
            HospitalizationPopupProcedureContentBuilder = (function () {
                function HospitalizationPopupProcedureContentBuilder() {
                    this.initialData = {};
                }
                HospitalizationPopupProcedureContentBuilder.prototype.build = function (data) {
                    var body = document.createElement('div');
                    var form = document.createElement('form');
                    form.classList.add('form');
                    this.initialData = data || {
                        'name': '',
                        'id': -1
                    };
                    var args = {
                        'id': 'procedure_select',
                        'data-title': 'Процедуры',
                        'data-subtitle': "Выберите процедуру",
                        'data-search': laroute.route('search.procedures'),
                        'data-search-alias': laroute.route('search.procedures'),
                        'data-search-placeholder': 'Введите фразу для поиска процедуры',
                        'data-empty': lang_1.default.get('global.select.empty')
                    };
                    if (this.initialData.id > 0) {
                        args['data-preload'] = laroute.route('search.procedure', { 'procedure': this.initialData.id });
                    }
                    console.log(this.initialData);
                    var procedure = form_1.Form.select('Процедура', 'procedure', [], args);
                    this.name = form_1.Form.hidden('name', '');
                    form.appendChild(procedure.container);
                    form.appendChild(this.name.container);
                    body.appendChild(form);
                    return body;
                };
                HospitalizationPopupProcedureContentBuilder.prototype.onPopupAppeared = function () {
                    application_1.default.callEmmitable('select');
                    select_1.findSelectById('procedure_select').addOnChangeEventListener(function (item) {
                        this.name.element.value = item.text;
                    }.bind(this));
                };
                return HospitalizationPopupProcedureContentBuilder;
            }());
            exports_1("default", HospitalizationPopupProcedureContentBuilder);
        }
    };
});

//# sourceMappingURL=hospitalization-popup-procedure-content-builder.js.map
