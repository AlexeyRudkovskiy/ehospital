var fs = require('fs');
var io = require('socket.io');
var redis = require('ioredis');

var config = JSON.parse(fs.readFileSync(__dirname + '/config/echo.json', 'utf8'));
var connections = [];

io = io.listen(config.port);
redis = new redis();

redis.psubscribe('*', function () { /* empty */ });

redis.on('pmessage', function (pattern, channel, message) {
    message = JSON.parse(message);
    var data = {
        channel: channel,
        message: {
            event: message.event,
            data: message.data
        }
    };

    for (var i = 0, length = connections.length; i < length; i++) {
        connections[i].emit('message', data);
    }
});

io.sockets.on('connection', function (socket) {
    connections.push(socket);
});
