System.register(['./MyService'], function(exports_1, context_1) {
    "use strict";
    var __moduleName = context_1 && context_1.id;
    var MyService_1;
    var service;
    return {
        setters:[
            function (MyService_1_1) {
                MyService_1 = MyService_1_1;
            }],
        execute: function() {
            service = new MyService_1.MyService();
            service.on('updates')
                .then(function (data) { return data * data; })
                .then(function (data) { return console.log(data); });
            service.on('eh.test')
                .then(function (data) { return console.log(data); });
            service.on('eh.medicament.*')
                .then(function (data) { return console.log('Medicament changed', data); });
            new Vue({
                el: function () { return 'body'; }
            });
        }
    }
});

//# sourceMappingURL=app.js.map
