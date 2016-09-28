"use strict";
function get(scope, variable) {
    return scope[variable];
}
exports.get = get;
function set(scope, variable, value) {
    scope[variable] = value;
}
exports.set = set;

//# sourceMappingURL=helpers.js.map
