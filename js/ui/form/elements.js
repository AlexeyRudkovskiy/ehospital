System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var Elements;
    return {
        setters: [],
        execute: function () {
            Elements = (function () {
                function Elements() {
                }
                Elements.text = function (label, name, value, placeholder) {
                    if (value === void 0) { value = null; }
                    if (placeholder === void 0) { placeholder = null; }
                    var container = document.createElement('div');
                    var labelContainer = document.createElement('div');
                    var inputContainer = document.createElement('div');
                    var labelElement = document.createElement('label');
                    var input = document.createElement('input');
                    container.classList.add('form-group');
                    labelContainer.classList.add('label');
                    inputContainer.classList.add('input-wrapper');
                    input.classList.add('input');
                    input.setAttribute('id', name);
                    input.setAttribute('name', name);
                    input.setAttribute('type', 'text');
                    if (typeof value !== "undefined" && value !== null) {
                        input.value = value;
                    }
                    if (typeof value !== "undefined" && placeholder !== null) {
                        input.setAttribute('placeholder', placeholder);
                    }
                    labelElement.setAttribute('for', name);
                    labelElement.innerHTML = label;
                    inputContainer.appendChild(input);
                    /*
            
                     <div class="form-group">
                         <div class="label">
                            <label for="firstName">First Name</label>
                         </div>
                         <div class="input-wrapper">
                            <input type="text" id="firstName" class="input" placeholder="First name" />
                         </div>
                     </div>
            
                     */
                    container.appendChild(labelContainer);
                    container.appendChild(inputContainer);
                    labelContainer.appendChild(labelElement);
                    return container;
                };
                return Elements;
            }());
            exports_1("default", Elements);
        }
    };
});

//# sourceMappingURL=elements.js.map
