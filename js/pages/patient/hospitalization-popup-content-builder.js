System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var HospitalizationPopupContentBuilder;
    return {
        setters: [],
        execute: function () {
            HospitalizationPopupContentBuilder = (function () {
                function HospitalizationPopupContentBuilder() {
                    this.measureInput = null;
                    this.nomenclatureInput = null;
                    this.measure = null;
                    this.initialData = null;
                }
                HospitalizationPopupContentBuilder.prototype.build = function (data) {
                    var body = document.createElement('div');
                    var form = document.createElement('form');
                    var nomenclatureInput = document.createElement('input');
                    var measureInput = document.createElement('input');
                    this.nomenclatureInput = nomenclatureInput;
                    this.measure = measureInput;
                    this.initialData = data || {
                        name: '',
                        measure: ''
                    };
                    nomenclatureInput.type = 'hidden';
                    nomenclatureInput.name = 'name';
                    measureInput.type = 'hidden';
                    measureInput.name = 'measure';
                    form.classList.add('form');
                    form.setAttribute('method', 'post');
                    form.setAttribute('action', '#');
                    var nomenclature = this.createNomenclatureInput();
                    var measure = this.createMeasureInput();
                    form.appendChild(nomenclature);
                    form.appendChild(measure);
                    form.appendChild(nomenclatureInput);
                    form.appendChild(measureInput);
                    nomenclatureInput.value = this.initialData.name;
                    measureInput.value = this.initialData.measure;
                    body.appendChild(form);
                    return body;
                };
                HospitalizationPopupContentBuilder.prototype.createNomenclatureInput = function () {
                    var nomenclature = document.createElement('div');
                    var nomenclatureLabelWrapper = document.createElement('div');
                    var nomenclatureLabel = document.createElement('label');
                    var nomenclatureInputWrapper = document.createElement('div');
                    var nomenclatureInput = document.createElement('input');
                    nomenclature.classList.add('form-group');
                    nomenclatureLabelWrapper.classList.add('label');
                    nomenclatureLabel.innerHTML = 'Медикамент';
                    nomenclatureInputWrapper.classList.add('input-wrapper');
                    nomenclatureInput.classList.add('input');
                    nomenclatureInput.setAttribute('name', 'nomenclature');
                    nomenclature.appendChild(nomenclatureLabelWrapper);
                    nomenclature.appendChild(nomenclatureInputWrapper);
                    nomenclatureLabelWrapper.appendChild(nomenclatureLabel);
                    nomenclatureInputWrapper.appendChild(nomenclatureInput);
                    nomenclatureInput.value = this.initialData.name;
                    nomenclatureInput.addEventListener('change', function () {
                        this.instance.nomenclatureInput.value = this.element.value;
                    }.bind({
                        instance: this,
                        element: nomenclatureInput
                    }));
                    return nomenclature;
                };
                HospitalizationPopupContentBuilder.prototype.createMeasureInput = function () {
                    var measure = document.createElement('div');
                    var measureLabelWrapper = document.createElement('div');
                    var measureLabel = document.createElement('label');
                    var measureInputWrapper = document.createElement('div');
                    var measureInput = document.createElement('input');
                    this.measureInput = measureInput;
                    measure.classList.add('form-group');
                    measureLabelWrapper.classList.add('label');
                    measureLabel.innerHTML = 'Дозировка';
                    measureInputWrapper.classList.add('input-wrapper');
                    measureInput.classList.add('input');
                    measureInput.setAttribute('name', 'measure_id');
                    measure.appendChild(measureLabelWrapper);
                    measure.appendChild(measureInputWrapper);
                    measureLabelWrapper.appendChild(measureLabel);
                    measureInputWrapper.appendChild(measureInput);
                    measureInput.value = this.initialData.measure;
                    measureInput.addEventListener('change', function () {
                        this.instance.measure.value = this.element.value;
                    }.bind({
                        instance: this,
                        element: measureInput
                    }));
                    return measure;
                };
                return HospitalizationPopupContentBuilder;
            }());
            exports_1("default", HospitalizationPopupContentBuilder);
        }
    };
});

//# sourceMappingURL=hospitalization-popup-content-builder.js.map
