"use strict";
var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var service_1 = require('./services/service');
var MyService = (function (_super) {
    __extends(MyService, _super);
    function MyService() {
        _super.call(this);
        this.io = null;
        this.ioPort = 5888;
        this.io = new window.io.connect(location.host + ":" + this.ioPort);
        this.io.on('message', this.onMessage.bind(this));
        MyService.instance = this;
    }
    MyService.prototype.onMessage = function (event) {
        console.log(event);
        this.emit(event.channel, event.message.data);
    };
    MyService.getInstance = function () {
        if (MyService.instance === null) {
            MyService.instance = new MyService();
        }
        return MyService.instance;
    };
    MyService.instance = null;
    return MyService;
}(service_1.Service));
exports.MyService = MyService;

//# sourceMappingURL=MyService.js.map
