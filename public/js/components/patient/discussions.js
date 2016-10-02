"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var vue_typescript_1 = require('vue-typescript');
var Discussions = (function () {
    function Discussions() {
        this.patientId = -1;
        this.comments = [];
    }
    Discussions.prototype.ready = function () {
        var _this = this;
        if (this.patientId < 1) {
            throw "patientId can't be lower than 1";
        }
        window.fetch('/api/patient/' + this.patientId + '/comments')
            .then(function (response) { return response.json(); })
            .then(function (response) { console.log(response); return response; })
            .then(function (response) { return _this.comments = response; });
    };
    __decorate([
        vue_typescript_1.Prop, 
        __metadata('design:type', Number)
    ], Discussions.prototype, "patientId", void 0);
    __decorate([
        vue_typescript_1.Prop, 
        __metadata('design:type', Object)
    ], Discussions.prototype, "comments", void 0);
    Discussions = __decorate([
        vue_typescript_1.VueComponent({
            template: require('/partials/patient/discussions.html!text'),
            name: 'discussions'
        }), 
        __metadata('design:paramtypes', [])
    ], Discussions);
    return Discussions;
}());
exports.Discussions = Discussions;

//# sourceMappingURL=discussions.js.map
