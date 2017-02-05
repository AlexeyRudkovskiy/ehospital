System.register(["../../ui/select"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function default_1(set) {
        return {
            text: set.name,
            value: set.id,
            createItem: function (instance, item) {
                var option = document.createElement('div');
                item.element = option;
                option.innerHTML = '<div>' + item.text + '</div><div class="item-description">' + item.metadata.count + '</div>';
                option.setAttribute('data-value', item.value);
                option.classList.add('select-option');
                option.addEventListener('click', select_1.onItemSelected.bind({
                    instance: instance,
                    current: item
                }));
                if (item.isSelected === true) {
                    option.classList.add('active');
                }
                return option;
            },
            element: null,
            isSelected: typeof set.selected !== "undefined" ? set.selected : false,
            metadata: set
        };
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

//# sourceMappingURL=set.js.map
