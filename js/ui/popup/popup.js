///<reference path="../../fixes.d.ts" />
System.register(["whatwg-fetch", "./html-content-builder", "../../lang", "/resources/spinner.svg!text"], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var html_content_builder_1, lang_1, spinner_svg_text_1, CONTENT_TYPES, Popup;
    return {
        setters: [
            function (_1) {
            },
            function (html_content_builder_1_1) {
                html_content_builder_1 = html_content_builder_1_1;
            },
            function (lang_1_1) {
                lang_1 = lang_1_1;
            },
            function (spinner_svg_text_1_1) {
                spinner_svg_text_1 = spinner_svg_text_1_1;
            }
        ],
        execute: function () {///<reference path="../../fixes.d.ts" />
            (function (CONTENT_TYPES) {
                CONTENT_TYPES[CONTENT_TYPES["JSON"] = 0] = "JSON";
                CONTENT_TYPES[CONTENT_TYPES["TEXT"] = 1] = "TEXT";
            })(CONTENT_TYPES || (CONTENT_TYPES = {}));
            Popup = (function () {
                function Popup(url, title, subtitle) {
                    if (url === void 0) { url = null; }
                    if (title === void 0) { title = null; }
                    if (subtitle === void 0) { subtitle = null; }
                    this.url = url;
                    this.title = title;
                    this.subtitle = subtitle;
                    this.header = null;
                    this._footer = null;
                    this.content = null;
                    this.loadedContentType = null;
                    this.minTopLocation = 50;
                    this._isForm = false;
                    this._jsonContentBuilder = null;
                    this._basicContentBuilder = null;
                    this._customClasses = [];
                    this._onPopupAppeared = null;
                    this.onSubmit = null;
                    Popup.openedPopupCount++;
                    this.currentPopupId = Popup.openedPopupCount;
                }
                Popup.prototype.show = function () {
                    document.body.appendChild(this.wrapper);
                    var functionContainer = {
                        instance: this
                    };
                    var callback = this.onKeyUpEventListener.bind(functionContainer);
                    functionContainer.callback = callback;
                    window.addEventListener('keyup', callback, true);
                    this.setPopupLocation();
                    if (this._onPopupAppeared !== null) {
                        this._onPopupAppeared.call(window, this);
                    }
                };
                Popup.prototype.close = function () {
                    Popup.openedPopupCount--;
                    document.body.removeChild(this.wrapper);
                };
                Popup.prototype.create = function (data, noContentPaddings) {
                    if (data === void 0) { data = null; }
                    if (noContentPaddings === void 0) { noContentPaddings = false; }
                    this.wrapper = document.createElement('div');
                    this.wrapper.classList.add('popup-wrapper');
                    this.wrapper.style.zIndex = this.popupId.toString();
                    if (this.url !== null) {
                        this.createLoader();
                        this.showLoader();
                    }
                    else {
                        var body = document.createElement('div');
                        body.classList.add('popup');
                        this.popup = body;
                        this.wrapper.appendChild(this.popup);
                        this.popup.classList.remove('popup-loader');
                        this.content = this._basicContentBuilder.build(data);
                        this.content.classList.add('popup-content');
                        if (noContentPaddings) {
                            this.popup.classList.add('popup-no-content-paddings');
                        }
                        this.popup.innerHTML = "";
                        for (var i = 0; i < this._customClasses.length; i++) {
                            this.popup.classList.add(this._customClasses[i]);
                        }
                        if (this.header === null) {
                            this.header = this.createHeader();
                        }
                        this.popup.appendChild(this.header);
                        if (this.content !== null) {
                            this.popup.appendChild(this.content);
                        }
                        if (this._footer === null) {
                            if (this._isForm) {
                                this._footer = this.createFormFooter();
                            }
                        }
                        if (typeof this._footer !== "undefined" && this._footer !== null) {
                            this.popup.appendChild(this._footer);
                        }
                        this.setPopupLocation();
                    }
                };
                Object.defineProperty(Popup.prototype, "popupId", {
                    get: function () {
                        return 100 + this.currentPopupId;
                    },
                    enumerable: true,
                    configurable: true
                });
                Popup.prototype.setPopupLocation = function () {
                    var screenHeight = window.innerHeight;
                    var popupHeight = this.popup.offsetHeight;
                    if (popupHeight > screenHeight - this.minTopLocation) {
                        this.popup.style.marginTop = this.minTopLocation + "px";
                    }
                    else {
                        this.popup.style.marginTop = (screenHeight / 2 - popupHeight / 2) + "px";
                    }
                };
                Popup.prototype.createLoader = function () {
                    var loader = document.createElement('div');
                    loader.classList.add('popup', 'popup-loader');
                    loader.innerHTML = spinner_svg_text_1.default;
                    this.popup = loader;
                };
                Popup.prototype.showLoader = function () {
                    var _this = this;
                    this.wrapper.appendChild(this.popup);
                    window.fetch(this.url)
                        .then(this.getContent.bind(this))
                        .then(this.buildContent.bind(this))
                        .then(function (builderStructure) { return builderStructure.builder.build(builderStructure.data); })
                        .then(function (element) { return _this.replaceLoaderWith(element); })
                        .catch(console.error.bind(console));
                };
                Popup.prototype.replaceLoaderWith = function (element) {
                    this.popup.classList.remove('popup-loader');
                    this.content = document.createElement('div');
                    this.content.classList.add('popup-content');
                    this.content.appendChild(element);
                    this.popup.innerHTML = "";
                    if (this.header === null) {
                        this.header = this.createHeader();
                    }
                    this.popup.appendChild(this.header);
                    if (this.content !== null) {
                        this.popup.appendChild(this.content);
                    }
                    if (this._footer === null) {
                        if (this._isForm) {
                            this._footer = this.createFormFooter();
                        }
                    }
                    if (typeof this._footer !== "undefined" && this._footer !== null) {
                        this.popup.appendChild(this._footer);
                    }
                    this.setPopupLocation();
                };
                Popup.prototype.getContent = function (response) {
                    var contentType = response.headers.get('content-type');
                    var type = null;
                    if (contentType.indexOf('application/json') !== -1) {
                        this.loadedContentType = CONTENT_TYPES.JSON;
                        return response.json();
                    }
                    else {
                        this.loadedContentType = CONTENT_TYPES.TEXT;
                        return response.text();
                    }
                };
                Popup.prototype.buildContent = function (data) {
                    var builder = null;
                    switch (this.loadedContentType) {
                        case CONTENT_TYPES.JSON:
                            if (this._jsonContentBuilder === null) {
                                throw "Popup::buildContent JSONContentBuilder is empty";
                            }
                            builder = this._jsonContentBuilder;
                            break;
                        case CONTENT_TYPES.TEXT:
                            builder = new html_content_builder_1.default();
                            break;
                    }
                    return {
                        builder: builder,
                        data: data
                    };
                };
                Popup.prototype.createHeader = function () {
                    var container = document.createElement('div');
                    var popupTitle = document.createElement('div');
                    var popupClose = document.createElement('div');
                    var close = document.createElement('i');
                    container.classList.add('popup-header', 'popup-header-large-bottom-offset');
                    popupTitle.classList.add('popup-title');
                    popupClose.classList.add('popup-close');
                    close.classList.add('material-icons');
                    close.innerHTML = 'close';
                    container.appendChild(popupTitle);
                    container.appendChild(popupClose);
                    popupClose.appendChild(close);
                    if (this.title !== null && this.title.length > 0) {
                        var title = document.createElement('p');
                        title.classList.add('title');
                        title.innerHTML = this.title;
                        popupTitle.appendChild(title);
                    }
                    if (this.subtitle !== null && this.subtitle.length > 0) {
                        var subtitle = document.createElement('p');
                        subtitle.classList.add('subtitle');
                        subtitle.innerHTML = this.subtitle;
                        popupTitle.appendChild(subtitle);
                    }
                    close.addEventListener('click', this.closePopup.bind(this));
                    return container;
                };
                Popup.prototype.createFormFooter = function () {
                    var container = document.createElement('div');
                    var pullRight = document.createElement('div');
                    var send = document.createElement('a');
                    container.classList.add('popup-footer');
                    pullRight.classList.add('pull-right');
                    send.classList.add('ghost-btn', 'ghost-btn-primary');
                    send.innerHTML = lang_1.default.get('ui.form.send');
                    send.setAttribute('href', 'javascript:');
                    container.appendChild(pullRight);
                    pullRight.appendChild(send);
                    send.addEventListener('click', this.sendPopupForm.bind(this));
                    return container;
                };
                Popup.prototype.closePopup = function (e) {
                    e.preventDefault();
                    this.close();
                };
                Popup.prototype.sendPopupForm = function (e) {
                    e.preventDefault();
                    if (this.onSubmit === null) {
                        this.content.querySelector('form').submit();
                    }
                    else {
                        this.onSubmit.call(window, this.content.querySelector('form'));
                    }
                };
                Popup.prototype.setOnSubmitEventListener = function (callback) {
                    this.onSubmit = callback;
                };
                Popup.prototype.onKeyUpEventListener = function (e) {
                    if (e.keyCode === Popup.ESC_KEY_CODE) {
                        window.removeEventListener('keyup', this.callback, true);
                        this.instance.close();
                    }
                };
                Object.defineProperty(Popup.prototype, "jsonContentBuilder", {
                    set: function (value) {
                        this._jsonContentBuilder = value;
                    },
                    enumerable: true,
                    configurable: true
                });
                Object.defineProperty(Popup.prototype, "basicContentBuilder", {
                    set: function (value) {
                        this._basicContentBuilder = value;
                    },
                    enumerable: true,
                    configurable: true
                });
                Object.defineProperty(Popup.prototype, "isForm", {
                    set: function (value) {
                        this._isForm = value;
                    },
                    enumerable: true,
                    configurable: true
                });
                Object.defineProperty(Popup.prototype, "customClasses", {
                    set: function (value) {
                        this._customClasses = value;
                    },
                    enumerable: true,
                    configurable: true
                });
                Object.defineProperty(Popup.prototype, "footer", {
                    set: function (value) {
                        this._footer = value;
                    },
                    enumerable: true,
                    configurable: true
                });
                Object.defineProperty(Popup.prototype, "onPopupAppeared", {
                    set: function (value) {
                        this._onPopupAppeared = value;
                    },
                    enumerable: true,
                    configurable: true
                });
                return Popup;
            }());
            Popup.openedPopupCount = 0;
            Popup.ESC_KEY_CODE = 27;
            exports_1("default", Popup);
        }
    };
});

//# sourceMappingURL=popup.js.map
