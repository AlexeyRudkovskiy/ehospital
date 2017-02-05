System.register(["react", "react-dom"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    function registerComponent(component, selector) {
        console.log(component, selector);
        components.push({
            component: component,
            selector: selector
        });
    }
    exports_1("registerComponent", registerComponent);
    function autobind() {
        components.forEach(function (component) { return react_dom_1.default.render(react_1.default.createElement(component.component, null), document.querySelector(component.selector)); });
        // components.forEach(component => ReactDOM.render(React.createElement(component.component, null), document.querySelector(component.selector)));
    }
    exports_1("autobind", autobind);
    var react_1, react_dom_1, components;
    return {
        setters: [
            function (react_1_1) {
                react_1 = react_1_1;
            },
            function (react_dom_1_1) {
                react_dom_1 = react_dom_1_1;
            }
        ],
        execute: function () {
            exports_1("components", components = []);
        }
    };
});

//# sourceMappingURL=react-contailer.js.map
