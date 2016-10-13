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
var api_1 = require("../../api");
var Balance = (function () {
    function Balance() {
        this.balance = 0.0;
        this.history = [];
        this.medicamentId = -1;
    }
    Balance.prototype.ready = function () {
        var _this = this;
        api_1.API
            .get('/api/medicament/' + (this.medicamentId) + '/history')
            .then(function (response) { return response.json(); })
            .then(function (response) { _this.history = response; });
        MyService_1.MyService.getInstance().on('eh.medicament.[0-9].history').then(this.onBalanceChanged.bind(this));
        MyService_1.MyService.getInstance().on('eh.medicament.[0-9].balance').then(this.onMedicamentChanged.bind(this));
    };
    Balance.prototype.onMedicamentChanged = function (response) {
        console.log(response, this);
    };
    Balance.prototype.onBalanceChanged = function (response) {
        this.history.unshift(response.history);
    };
    __decorate([
        vue_typescript_1.Prop, 
        __metadata('design:type', Number)
    ], Balance.prototype, "balance", void 0);
    __decorate([
        vue_typescript_1.Prop, 
        __metadata('design:type', Object)
    ], Balance.prototype, "history", void 0);
    __decorate([
        vue_typescript_1.Prop, 
        __metadata('design:type', Number)
    ], Balance.prototype, "medicamentId", void 0);
    Balance = __decorate([
        vue_typescript_1.VueComponent({
            template: require('/partials/balance.html!text')
        }), 
        __metadata('design:paramtypes', [])
    ], Balance);
    return Balance;
}());
exports.Balance = Balance;

//# sourceMappingURL=balance.js.map
