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
var MyService_1 = require('../../MyService');
var BalanceComponent = (function () {
    function BalanceComponent() {
        this.balance = 0.0;
    }
    BalanceComponent.prototype.ready = function () {
        var _this = this;
        MyService_1.MyService.getInstance().on('eh.medicament.[0-9].income').then(function (response) { return _this.balance = response.balance; });
    };
    __decorate([
        vue_typescript_1.Prop, 
        __metadata('design:type', Number)
    ], BalanceComponent.prototype, "balance", void 0);
    BalanceComponent = __decorate([
        vue_typescript_1.VueComponent({
            template: '<b>Balance: {{ balance }}</b>'
        }), 
        __metadata('design:paramtypes', [])
    ], BalanceComponent);
    return BalanceComponent;
}());
exports.BalanceComponent = BalanceComponent;

//# sourceMappingURL=balance-component.js.map
