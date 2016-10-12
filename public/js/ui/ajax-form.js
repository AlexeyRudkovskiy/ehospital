"use strict";
var AjaxForm = (function () {
    function AjaxForm(form, onFormSentEvent) {
        this.form = form;
        this.onFormSentEvent = onFormSentEvent;
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            this.onFormSent();
        }.bind(this));
    }
    AjaxForm.prototype.onFormSent = function () {
        var _this = this;
        var url = this.form.action;
        var data = new FormData(this.form);
        var method = this.form.method;
        window.fetch(url, {
            method: method,
            credentials: 'same-origin',
            headers: {
                'x-token': window.token
            },
            body: data
        })
            .then(function (response) { return response.json(); })
            .then(function (response) { return _this.onFormSentEvent.call(window, response); });
    };
    return AjaxForm;
}());
exports.AjaxForm = AjaxForm;

//# sourceMappingURL=ajax-form.js.map
