"use strict";
var InlinePopup = (function () {
    function InlinePopup(target, content, ajax, config) {
        if (ajax === void 0) { ajax = false; }
        if (config === void 0) { config = {}; }
        this.target = target;
        this.content = content;
        this.ajax = ajax;
        this.config = config;
        this.pageMargins = 15;
        this.onLoadedFunc = null;
        if (typeof config['maxWidth'] === "undefined") {
            this.config['maxWidth'] = 300;
        }
    }
    InlinePopup.prototype.setOnLoadedEventListener = function (func) {
        this.onLoadedFunc = func;
        return this;
    };
    InlinePopup.prototype.show = function () {
        if (InlinePopup.element != null) {
            InlinePopup.element.parentElement.removeChild(InlinePopup.element);
        }
        if (this.ajax) {
            var request = window.fetch(this.content, {
                credentials: 'same-origin'
            })
                .then(function (response) { return response.text(); })
                .then(this.onContentLoaded.bind(this));
        }
        return this;
    };
    InlinePopup.prototype.onContentLoaded = function (response) {
        var offsetTop = this.target.offsetTop;
        var offsetLeft = this.target.offsetLeft;
        var offsetWidth = this.target.offsetWidth;
        var offsetHeight = this.target.offsetHeight;
        var popup = document.createElement('div');
        var popupContent = document.createElement('div');
        var popupClose = document.createElement('div');
        var popupTriangle = document.createElement('div');
        popup.classList.add('inline-popup');
        popupClose.classList.add('inline-popup-close');
        popupContent.classList.add('inline-popup-content');
        popupTriangle.classList.add('inline-popup-triangle');
        popup.appendChild(popupContent);
        popup.appendChild(popupClose);
        popup.appendChild(popupTriangle);
        popupContent.innerHTML = response;
        InlinePopup.element = popup;
        document.querySelector('.container .content').appendChild(popup);
        popup.style.top = "0px";
        popup.style.left = "0px";
        this.root = popupContent.firstChild;
        if (popup.offsetWidth > this.config.maxWidth) {
            var maxWidth = this.config.maxWidth;
            popup.style.width = maxWidth + 'px';
        }
        popup.style.top = (offsetTop + offsetHeight) + "px";
        var popupLeftPosition = offsetLeft - popup.offsetWidth / 2;
        popup.style.left = (popupLeftPosition) + "px";
        popupTriangle.style.left = (popup.offsetWidth / 2) + "px";
        popupTriangle.style.marginLeft = "17px";
        if (this.onLoadedFunc != null) {
            this.onLoadedFunc.call(window, this.root);
        }
    };
    InlinePopup.element = null;
    return InlinePopup;
}());
exports.InlinePopup = InlinePopup;

//# sourceMappingURL=inline-popup.js.map
