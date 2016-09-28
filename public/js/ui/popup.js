"use strict";
var Popup = (function () {
    function Popup(content, ajax, config) {
        if (ajax === void 0) { ajax = false; }
        if (config === void 0) { config = {}; }
        this.content = content;
        this.ajax = ajax;
        this.config = config;
    }
    Popup.prototype.show = function () {
        var _this = this;
        var request = window.fetch(this.content, {
            credentials: 'same-origin'
        })
            .then(function (response) { return response.text(); })
            .then(function (response) { return _this.onContentLoaded(response); });
        return this;
    };
    Popup.prototype.onContentLoaded = function (response) {
        var popup = document.createElement('div');
        var content = document.createElement('div');
        popup.classList.add('popup');
        content.classList.add('content');
        popup.appendChild(content);
        content.innerHTML = response;
        var forms = content.querySelectorAll('form');
        for (var i = 0; i < forms.length; i++) {
            forms[i].addEventListener('submit', this.onFormSubmited);
        }
        document.body.appendChild(popup);
        this.element = popup;
    };
    Popup.prototype.onFormSubmited = function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var token = formData.get('_token');
        window.fetch(this.getAttribute('action'), {
            method: this.getAttribute('method'),
            body: formData,
            credentials: 'same-origin',
            headers: {
                'Cookie': document.cookie
            }
        }).then(this.onFormResponse);
    };
    Popup.prototype.onFormResponse = function () {
        if (typeof this.config['close_after_form_submit'] !== "undefined" && this.config['close_after_form_submit'] == true) {
            this.element.parentElement.removeChild(this.element);
        }
    };
    return Popup;
}());
exports.Popup = Popup;

//# sourceMappingURL=popup.js.map
