System.register(['./services/service'], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var __extends = (this && this.__extends) || function (d, b) {
        for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
    var service_1;
    var MyService;
    return {
        setters:[
            function (service_1_1) {
                service_1 = service_1_1;
            }],
        execute: function() {
            MyService = (function (_super) {
                __extends(MyService, _super);
                function MyService() {
                    _super.call(this);
                    this.ioPort = 5888;
                    this.io = new window.io(location.host + ":" + this.ioPort);
                    this.io.on('message', this.onMessage.bind(this));
                }
                MyService.prototype.onMessage = function (event) {
                    this.emit(event.channel, event.message.data);
                };
                return MyService;
            }(service_1.Service));
            exports_1("MyService", MyService);
        }
    }
});

//# sourceMappingURL=MyService.js.map
