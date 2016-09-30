"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var notification_1 = require('./notification');
var vue_typescript_1 = require("vue-typescript");
vue_typescript_1.VueComponent({
    template: require('/partials/notification.html!text')
});
var MedicamentBatchCreatedNotification = (function (_super) {
    __extends(MedicamentBatchCreatedNotification, _super);
    function MedicamentBatchCreatedNotification() {
        _super.apply(this, arguments);
    }
    MedicamentBatchCreatedNotification.prototype.ready = function () {
        this.text = "New text";
    };
    return MedicamentBatchCreatedNotification;
}(notification_1.Notification));
exports.MedicamentBatchCreatedNotification = MedicamentBatchCreatedNotification;

//# sourceMappingURL=medicament-batch-created-notification.js.map
