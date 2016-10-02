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
var NotificationsListComponent = (function () {
    function NotificationsListComponent() {
        this.notifications = [];
    }
    NotificationsListComponent.prototype.ready = function () {
        MyService_1.MyService.getInstance().on('eh.notification.1').then(this.onNewNotification);
    };
    NotificationsListComponent.prototype.deleteNotification = function (index) {
        this.notifications.splice(index, 1);
    };
    NotificationsListComponent.prototype.onNewNotification = function (item) {
        console.log(item);
        this.notifications.push(item);
    };
    __decorate([
        vue_typescript_1.Prop, 
        __metadata('design:type', Array)
    ], NotificationsListComponent.prototype, "notifications", void 0);
    NotificationsListComponent = __decorate([
        vue_typescript_1.VueComponent({
            template: require('/partials/notifications.html!text')
        }), 
        __metadata('design:paramtypes', [])
    ], NotificationsListComponent);
    return NotificationsListComponent;
}());
exports.NotificationsListComponent = NotificationsListComponent;

//# sourceMappingURL=notifications-list-component.js.map
