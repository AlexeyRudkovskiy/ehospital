System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var Form;
    return {
        setters: [],
        execute: function () {
            Form = (function () {
                function Form() {
                }
                Form.wrapper = function () {
                    var wrapperInfo = {};
                    var container = document.createElement('div');
                    var inputLabelWrapper = document.createElement('div');
                    var inputWrapper = document.createElement('div');
                    container.classList.add('form-group');
                    inputLabelWrapper.classList.add('label');
                    inputWrapper.classList.add('input-wrapper');
                    container.appendChild(inputLabelWrapper);
                    container.appendChild(inputWrapper);
                    wrapperInfo.container = container;
                    wrapperInfo.labelContainer = inputLabelWrapper;
                    wrapperInfo.inputContainer = inputWrapper;
                    return wrapperInfo;
                };
                Form.likeInput = function (label, value) {
                    var emptyWrapper = Form.wrapper();
                    var elementInfo = {};
                    var labelElement = document.createElement('label');
                    var inputElement = document.createElement('span');
                    emptyWrapper.labelContainer.appendChild(labelElement);
                    emptyWrapper.inputContainer.appendChild(inputElement);
                    labelElement.innerHTML = label;
                    inputElement.innerHTML = value;
                    elementInfo.container = emptyWrapper.container;
                    elementInfo.element = inputElement;
                    elementInfo.elementWrapper = emptyWrapper.inputContainer;
                    elementInfo.label = label;
                    elementInfo.value = value;
                    return elementInfo;
                };
                Form.select = function (label, name, options, args) {
                    if (options === void 0) { options = []; }
                    if (args === void 0) { args = {}; }
                    var elementInfo = {};
                    var wrapper = Form.wrapper();
                    var labelElement = document.createElement('label');
                    labelElement.innerHTML = label;
                    var select = document.createElement('select');
                    select.name = name;
                    select.classList.add('input');
                    for (var i = 0; i < options.length; i++) {
                        var option = document.createElement('option');
                        option.innerHTML = options[i].text;
                        option.value = options[i].value;
                        options[i].element = option;
                        select.appendChild(option);
                    }
                    for (var key in args) {
                        select.setAttribute(key, args[key]);
                    }
                    wrapper.inputContainer.appendChild(select);
                    wrapper.labelContainer.appendChild(labelElement);
                    elementInfo.container = wrapper.container;
                    elementInfo.element = select;
                    elementInfo.label = label;
                    elementInfo.elementWrapper = wrapper.inputContainer;
                    return elementInfo;
                };
                Form.text = function (label, name, attributes, value) {
                    if (attributes === void 0) { attributes = {}; }
                    if (value === void 0) { value = ''; }
                    var elementInfo = {};
                    var container = document.createElement('div');
                    var inputLabelWrapper = document.createElement('div');
                    var inputLabel = document.createElement('label');
                    var inputWrapper = document.createElement('div');
                    var element = document.createElement('input');
                    container.classList.add('form-group');
                    inputLabelWrapper.classList.add('label');
                    inputLabel.innerHTML = label;
                    inputWrapper.classList.add('input-wrapper');
                    element.classList.add('input');
                    element.setAttribute('type', 'text');
                    element.setAttribute('name', name);
                    for (var key in attributes) {
                        element.setAttribute(key, attributes[key]);
                    }
                    container.appendChild(inputLabelWrapper);
                    container.appendChild(inputWrapper);
                    inputLabelWrapper.appendChild(inputLabel);
                    inputWrapper.appendChild(element);
                    element.value = value;
                    elementInfo.label = label;
                    elementInfo.value = value;
                    elementInfo.elementWrapper = inputWrapper;
                    elementInfo.element = element;
                    elementInfo.container = container;
                    return elementInfo;
                };
                Form.number = function (label, name, attributes, value) {
                    if (attributes === void 0) { attributes = {}; }
                    if (value === void 0) { value = ''; }
                    var info = Form.text(label, name, attributes, value);
                    info.element.setAttribute('type', 'number');
                    return info;
                };
                Form.hidden = function (name, value) {
                    var container = {};
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = name;
                    input.value = value;
                    container.container = input;
                    container.element = input;
                    return container;
                };
                Form.checkbox = function (label, name, value, hideLabel) {
                    if (hideLabel === void 0) { hideLabel = false; }
                    var container = {};
                    var wrapper = document.createElement('div');
                    var labelWrapper = document.createElement('div');
                    var inputWrapper = document.createElement('div');
                    wrapper.classList.add('form-group');
                    labelWrapper.classList.add('label');
                    inputWrapper.classList.add('input-wrapper');
                    inputWrapper.classList.add('checkbox-group');
                    container.container = wrapper;
                    container.elementWrapper = inputWrapper;
                    labelWrapper.innerHTML = label;
                    wrapper.appendChild(labelWrapper);
                    wrapper.appendChild(inputWrapper);
                    var checkboxWrapper = document.createElement('label');
                    var checkbox = document.createElement('input');
                    var checkboxInputWrapper = document.createElement('span');
                    var inputLabel = document.createElement('span');
                    container.element = checkbox;
                    checkboxWrapper.appendChild(checkbox);
                    checkboxWrapper.appendChild(checkboxInputWrapper);
                    checkboxWrapper.appendChild(inputLabel);
                    checkbox.name = name;
                    checkbox.value = value;
                    checkbox.type = 'checkbox';
                    checkboxInputWrapper.classList.add('input-wrapper');
                    inputLabel.classList.add('input-label');
                    inputLabel.innerHTML = label;
                    inputWrapper.appendChild(checkboxWrapper);
                    if (hideLabel) {
                        labelWrapper.classList.add('hide');
                        wrapper.classList.add('has-offset');
                        wrapper.classList.add('force');
                    }
                    return container;
                };
                return Form;
            }());
            exports_1("Form", Form);
        }
    };
});

//# sourceMappingURL=form.js.map
