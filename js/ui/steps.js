System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function onNextClicked() {
        if (this.instance.current < this.instance.elements.length - 1) {
            this.instance.current++;
            for (var i = 0; i < this.instance.elements.length; i++) {
                this.instance.elements[i].hide();
            }
            this.instance.elements[this.instance.current].show();
        }
    }
    function default_1() {
        var localSteps = document.querySelectorAll('.steps');
        for (var i = 0; i < localSteps.length; i++) {
            var steps = localSteps[i].querySelectorAll('.step');
            var stepableInstance = new Stepable();
            for (var j = 0; j < steps.length; j++) {
                var stepableItem = new StepableItem();
                stepableItem.element = steps[j];
                stepableInstance.elements.push(stepableItem);
            }
            stepableInstance.nextStep = localSteps[i].querySelector('.next-step');
            stepableInstance.nextStep.addEventListener('click', onNextClicked.bind({
                element: stepableInstance.nextStep,
                instance: stepableInstance
            }));
            stepableInstance.nextStep.click();
            stepable.push(stepableInstance);
        }
    }
    exports_1("default", default_1);
    var StepableItem, Stepable, stepable;
    return {
        setters: [],
        execute: function () {
            StepableItem = (function () {
                function StepableItem() {
                }
                StepableItem.prototype.show = function () {
                    this.element.classList.add('visible');
                };
                StepableItem.prototype.hide = function () {
                    this.element.classList.remove('visible');
                };
                return StepableItem;
            }());
            Stepable = (function () {
                function Stepable() {
                    this.elements = [];
                    this.current = -1;
                }
                return Stepable;
            }());
            stepable = [];
        }
    };
});

//# sourceMappingURL=steps.js.map
