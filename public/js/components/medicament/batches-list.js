/// <reference path="../../../../../typings/index.d.ts" />
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
var MyService_1 = require("../../MyService");
var BatchesList = (function () {
    function BatchesList() {
        this.items = [];
        this.test = "Test";
    }
    BatchesList.prototype.ready = function () {
        var _this = this;
        MyService_1.MyService.getInstance().on('eh.medicament.[0-9].batch.created.*').then(function (item) { return _this.onBatchCreated(item); });
    };
    BatchesList.prototype.onBatchCreated = function (event) {
        this.items.push(event.batch);
        console.log(this);
    };
    BatchesList.prototype.testFunc = function () {
        console.log(arguments);
    };
    __decorate([
        vue_typescript_1.Prop, 
        __metadata('design:type', Object)
    ], BatchesList.prototype, "items", void 0);
    __decorate([
        vue_typescript_1.Prop, 
        __metadata('design:type', String)
    ], BatchesList.prototype, "test", void 0);
    __decorate([
        vue_typescript_1.Watch('items'), 
        __metadata('design:type', Function), 
        __metadata('design:paramtypes', []), 
        __metadata('design:returntype', void 0)
    ], BatchesList.prototype, "testFunc", null);
    BatchesList = __decorate([
        vue_typescript_1.VueComponent({
            template: require('/partials/batches-list.html!text')
        }), 
        __metadata('design:paramtypes', [])
    ], BatchesList);
    return BatchesList;
}());
exports.BatchesList = BatchesList;

//# sourceMappingURL=batches-list.js.map
