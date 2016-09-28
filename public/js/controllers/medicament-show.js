"use strict";
var popup_1 = require('../ui/popup');
var MedicamentShow = (function () {
    function MedicamentShow() {
        this.income = document.querySelector('#medicament_income');
        this.outgoing = document.querySelector('#medicament_outgoing');
        this.income.addEventListener('click', this.onIncomeButtonClicked.bind(this));
        this.outgoing.addEventListener('click', this.onOutgoingButtonClicked.bind(this));
    }
    MedicamentShow.prototype.onIncomeButtonClicked = function () {
        var popup = new popup_1.Popup(this.url('income'), true, {
            close_after_form_submit: true
        });
        popup.show();
    };
    MedicamentShow.prototype.onOutgoingButtonClicked = function () {
        var popup = new popup_1.Popup(this.url('outgoing'), true, {
            close_after_form_submit: true
        });
        popup.show();
    };
    MedicamentShow.prototype.url = function (path) {
        return "/management/medicament/" + (window.medicament.id) + "/" + path;
    };
    return MedicamentShow;
}());
exports.MedicamentShow = MedicamentShow;

//# sourceMappingURL=medicament-show.js.map
