System.register([], function (exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var Notification, Notifications, NotificationBuilder, NotificationActionBuilder, notifications;
    return {
        setters: [],
        execute: function () {
            Notification = (function () {
                function Notification() {
                }
                Notification.prototype.notify = function () {
                    notifications.notify(this);
                };
                return Notification;
            }());
            exports_1("Notification", Notification);
            Notifications = (function () {
                function Notifications() {
                    this.container = document.querySelector('#notifications-container');
                }
                Notifications.prototype.notify = function (notification) {
                    var element = this.createNotificationElement(notification);
                    var timeoutArgs = {
                        element: element,
                        instance: this
                    };
                    var mouseOverArgs = {
                        element: element
                    };
                    var timeoutCallback = this.onTimeout.bind(timeoutArgs);
                    var mouseOverListener = this.onMouseOver.bind(mouseOverArgs);
                    mouseOverArgs.listener = mouseOverListener;
                    this.container.appendChild(element);
                    var timerId = window.setTimeout(timeoutCallback, 2 * 1000);
                    mouseOverArgs.timerId = timerId;
                    notification.timerId = timerId;
                    element.addEventListener('mouseover', mouseOverListener);
                };
                Notifications.prototype.createNotificationElement = function (notification) {
                    var element = document.createElement('div');
                    var contentWrapper = document.createElement('div');
                    var content = document.createElement('div');
                    var close = document.createElement('div');
                    var closeIcon = document.createElement('i');
                    element.appendChild(contentWrapper);
                    element.appendChild(close);
                    element.classList.add('notification');
                    switch (notification.type) {
                        case 'success':
                            element.classList.add('notification-success');
                            break;
                        case 'danger':
                            element.classList.add('notification-danger');
                            break;
                    }
                    contentWrapper.appendChild(content);
                    contentWrapper.classList.add('notification-content');
                    content.innerHTML = notification.text;
                    close.appendChild(closeIcon);
                    close.classList.add('notification-close');
                    closeIcon.classList.add('material-icons');
                    closeIcon.innerHTML = 'close';
                    if (typeof notification.actions !== "undefined" && notification.actions.length > 0) {
                        var actions = document.createElement('div');
                        var btnGroup = document.createElement('div');
                        actions.classList.add('notification-actions');
                        btnGroup.classList.add('btn-group');
                        for (var i = 0; i < notification.actions.length; i++) {
                            var btn = document.createElement('a');
                            btn.innerHTML = notification.actions[i].text;
                            btn.href = notification.actions[i].url;
                            btn.classList.add('btn');
                            btnGroup.appendChild(btn);
                        }
                        actions.appendChild(btnGroup);
                        contentWrapper.appendChild(actions);
                    }
                    notification.element = element;
                    close.addEventListener('click', function () {
                        this.element.parentElement.removeChild(this.element);
                        window.clearTimeout(this.timerId);
                    }.bind(notification));
                    return element;
                };
                Notifications.prototype.onTimeout = function () {
                    this.element.parentElement.removeChild(this.element);
                };
                Notifications.prototype.onMouseOver = function () {
                    window.clearTimeout(this.timerId);
                    this.element.removeEventListener('mouseover', this.listener);
                };
                Notifications.prototype.onCloseClickedEventListener = function () {
                };
                return Notifications;
            }());
            NotificationBuilder = (function () {
                function NotificationBuilder() {
                    this._actions = [];
                }
                NotificationBuilder.prototype.setText = function (value) {
                    this._text = value;
                    return this;
                };
                NotificationBuilder.prototype.setType = function (value) {
                    this._type = value;
                    return this;
                };
                NotificationBuilder.prototype.addAction = function () {
                    var notificationActionBuilder = new NotificationActionBuilder(this);
                    this._actions.push(notificationActionBuilder);
                    return notificationActionBuilder;
                };
                NotificationBuilder.prototype.build = function () {
                    var actions = this._actions.map(function (action) { return action.build(); });
                    var notification = new Notification();
                    notification.text = this._text;
                    notification.type = this._type;
                    notification.actions = actions;
                    return notification;
                };
                NotificationBuilder.prototype.notify = function () {
                    this.build().notify();
                };
                return NotificationBuilder;
            }());
            exports_1("NotificationBuilder", NotificationBuilder);
            NotificationActionBuilder = (function () {
                function NotificationActionBuilder(builder) {
                    this.builder = builder;
                }
                NotificationActionBuilder.prototype.setText = function (value) {
                    this._text = value;
                    return this;
                };
                NotificationActionBuilder.prototype.setUrl = function (value) {
                    this._url = value;
                    return this;
                };
                NotificationActionBuilder.prototype.build = function () {
                    return {
                        text: this._text,
                        url: this._url
                    };
                };
                NotificationActionBuilder.prototype.stop = function () {
                    return this.builder;
                };
                return NotificationActionBuilder;
            }());
            exports_1("NotificationActionBuilder", NotificationActionBuilder);
            notifications = new Notifications;
            window.notifications = notifications;
            exports_1("default", notifications);
        }
    };
});

//# sourceMappingURL=notifications.js.map
