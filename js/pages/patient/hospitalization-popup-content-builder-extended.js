System.register(["../../ui/form", "../../application", "/js/laroute.js", "../../lang", "../../ui/select"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var form_1, application_1, laroute_js_1, lang_1, select_1, HospitalizationPopupContentBuilderExtended;
    return {
        setters: [
            function (form_1_1) {
                form_1 = form_1_1;
            },
            function (application_1_1) {
                application_1 = application_1_1;
            },
            function (laroute_js_1_1) {
                laroute_js_1 = laroute_js_1_1;
            },
            function (lang_1_1) {
                lang_1 = lang_1_1;
            },
            function (select_1_1) {
                select_1 = select_1_1;
            }
        ],
        execute: function () {
            HospitalizationPopupContentBuilderExtended = (function () {
                function HospitalizationPopupContentBuilderExtended() {
                    this.name = null;
                    this.measure = null;
                    this.originName = null;
                    this.initialData = null;
                    this.nomenclatureContainer = null;
                    this.unitContainer = null;
                    this.setContainer = null;
                }
                HospitalizationPopupContentBuilderExtended.prototype.build = function (data) {
                    var body = document.createElement('div');
                    var form = document.createElement('form');
                    this.initialData = data || {
                        name: '',
                        measure: '',
                        nomenclature_id: '',
                        unit_id: '',
                        amount: '',
                        originName: '',
                        is_set: false,
                        set_id: -1
                    };
                    if (typeof this.initialData.originName !== "undefined" && this.initialData.originName.length < 1) {
                        this.initialData.originName = this.initialData.name;
                    }
                    else if (typeof this.initialData.originName === "undefined") {
                        this.initialData.originName = this.initialData.name;
                    }
                    form.classList.add('form');
                    form.setAttribute('method', 'post');
                    form.setAttribute('action', '#');
                    var medicamentName = form_1.Form.likeInput('Медикамент', data.name);
                    var medicamentAmount = form_1.Form.likeInput('Колличество', data.measure);
                    var amount = form_1.Form.number('Колличество', 'amount', {}, this.initialData.amount);
                    if (this.initialData.originName !== this.initialData.name) {
                        medicamentName.element.innerHTML = this.initialData.name + ' (' + this.initialData.originName + ')';
                    }
                    if (typeof this.initialData.amount !== "undefined" && this.initialData.amount.length > 0) {
                        medicamentAmount.element.innerHTML = this.initialData.amount + ' (' + this.initialData.measure + ')';
                    }
                    var measureInput = form_1.Form.hidden('measure', this.initialData.measure);
                    var nameInput = form_1.Form.hidden('name', this.initialData.name);
                    var originName = form_1.Form.hidden('origin_name', this.initialData.originName);
                    this.originName = originName.element;
                    this.name = nameInput.element;
                    var nomenclatureSelectArguments = {
                        id: 'nomenclature_select',
                        'data-title': 'Номенклатуры',
                        'data-subtitle': "Выберите номенклатуру",
                        'data-search': laroute_js_1.default.route('search.nomenclatures') + "?sets_link=1",
                        'data-search-alias': laroute_js_1.default.route('search.nomenclatures'),
                        'data-search-placeholder': 'Введите фразу для поиска номенклатур',
                        'data-empty': lang_1.default.get('global.select.empty')
                    };
                    var departmentId = window.department.id;
                    var setSelectArguments = {
                        'id': 'set_select',
                        'data-title': 'Наборы',
                        'data-subtitle': "Выберите набор",
                        'data-search': laroute_js_1.default.route('search.sets', { department: departmentId }),
                        'data-search-alias': laroute_js_1.default.route('search.sets', { department: 0 }),
                        'data-search-placeholder': 'Введите фразу для поиска наборп',
                        'data-empty': lang_1.default.get('global.select.empty')
                    };
                    if (!this.initialData.is_set && typeof this.initialData.nomenclature_id !== "undefined" && this.initialData.nomenclature_id !== '') {
                        nomenclatureSelectArguments['data-preload'] = laroute_js_1.default.route('search.nomenclature', {
                            nomenclature: this.initialData.nomenclature_id
                        }) + '?unit_id=' + this.initialData.unit_id;
                    }
                    if (this.initialData.is_set && typeof this.initialData.set_id !== "undefined" && this.initialData.set_id !== '') {
                        setSelectArguments['data-preload'] = laroute_js_1.default.route('search.sets_default', {
                            department: departmentId
                        }) + '?set_id=' + this.initialData.set_id;
                    }
                    var nomenclatureSelect = form_1.Form.select('Номенклатура', 'nomenclature_id', [], nomenclatureSelectArguments);
                    var setSelect = form_1.Form.select('Набор', 'set', [], setSelectArguments);
                    var unitSelect = form_1.Form.select('Единица измерения', 'unit_id', [], {
                        id: 'unit_select',
                        'data-title': 'Единицы измерения',
                        'data-subtitle': "Выберите единицу измерения",
                        'data-search-alias': laroute_js_1.default.route('search.units'),
                        'data-empty': lang_1.default.get('global.select.empty')
                    });
                    var useSetInsteadOfNomenclature = form_1.Form.checkbox(lang_1.default.get('ui.hospitalization.popup.use_set_instead_of_nomenclature'), 'use_set_instead_of_nomenclature', 'yes', true);
                    useSetInsteadOfNomenclature.element.addEventListener('change', this.onCheckboxChanged.bind({
                        instance: this,
                        element: useSetInsteadOfNomenclature.element
                    }));
                    form.appendChild(medicamentName.container);
                    form.appendChild(medicamentAmount.container);
                    form.appendChild(useSetInsteadOfNomenclature.container);
                    form.appendChild(nomenclatureSelect.container);
                    form.appendChild(unitSelect.container);
                    form.appendChild(setSelect.container);
                    form.appendChild(amount.container);
                    form.appendChild(measureInput.container);
                    form.appendChild(nameInput.container);
                    form.appendChild(originName.container);
                    setSelect.container.classList.add('hide');
                    body.appendChild(form);
                    this.nomenclatureContainer = nomenclatureSelect.container;
                    this.unitContainer = unitSelect.container;
                    this.setContainer = setSelect.container;
                    if (this.initialData.is_set) {
                        setSelect.container.classList.remove('hide');
                        nomenclatureSelect.container.classList.add('hide');
                        unitSelect.container.classList.add('hide');
                        useSetInsteadOfNomenclature.element.checked = true;
                    }
                    return body;
                };
                HospitalizationPopupContentBuilderExtended.prototype.onPopupAppeared = function () {
                    application_1.default.callEmmitable('select');
                    var nomenclatureSelectContainer = select_1.findSelectById('nomenclature_select');
                    var unitSelectContainer = select_1.findSelectById('unit_select');
                    var setSelectContainer = select_1.findSelectById('set_select');
                    nomenclatureSelectContainer.addOnChangeEventListener(function (nomenclature) {
                        this.unitSelect.processItems(nomenclature.metadata.units);
                        this.unitSelect.setPlaceholderText();
                        this.instance.name.value = nomenclature.text;
                    }.bind({
                        unitSelect: unitSelectContainer,
                        instance: this
                    }));
                    setSelectContainer.addOnChangeEventListener(function (set) {
                        this.name.value = set.text;
                    }.bind(this));
                };
                HospitalizationPopupContentBuilderExtended.prototype.onCheckboxChanged = function () {
                    this.instance.nomenclatureContainer.classList.toggle('hide');
                    this.instance.unitContainer.classList.toggle('hide');
                    this.instance.setContainer.classList.toggle('hide');
                };
                return HospitalizationPopupContentBuilderExtended;
            }());
            exports_1("default", HospitalizationPopupContentBuilderExtended);
        }
    };
});

//# sourceMappingURL=hospitalization-popup-content-builder-extended.js.map
