///<reference path="./fixes.d.ts" />
System.register(["/lang.json!json"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var lang_json_json_1, Lang, lang;
    return {
        setters: [
            function (lang_json_json_1_1) {
                lang_json_json_1 = lang_json_json_1_1;
            }
        ],
        execute: function () {///<reference path="./fixes.d.ts" />
            Lang = (function () {
                function Lang() {
                    this.langSchema = null;
                    this.langSchema = lang_json_json_1.default;
                }
                Lang.prototype.get = function (key) {
                    var schema = this.langSchema;
                    var path = key.split('.');
                    var currentKey = path.shift();
                    do {
                        if (this.isKeyExist(schema, currentKey, key)) {
                            schema = schema[currentKey];
                            currentKey = path.shift();
                        }
                    } while (path.length > 0);
                    if (this.isKeyExist(schema, currentKey, key)) {
                        return schema[currentKey];
                    }
                    return null;
                };
                Lang.prototype.isKeyExist = function (schema, key, fullPath) {
                    if (typeof schema[key] === "undefined") {
                        throw "Can't find '" + key + "' key. Full path: " + fullPath;
                    }
                    return true;
                };
                return Lang;
            }());
            lang = new Lang();
            exports_1("default", lang);
        }
    };
});

//# sourceMappingURL=lang.js.map
