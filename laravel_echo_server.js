var fs = require('fs');
var io = require('socket.io');
var redis = require('ioredis');

var config = JSON.parse(fs.readFileSync(__dirname + '/config/echo.json', 'utf8'));
var connections = [];

io = io.listen(config.port);
redis = new redis();

redis.psubscribe('*', function () { console.log('[SERVER] Connected to redis server'); });

redis.on('pmessage', function (pattern, channel, message) {
    message = JSON.parse(message);
    var data = {
        channel: channel,
        message: {
            event: message.event,
            data: message.data
        }
    };

    console.log('[SERVER] New event: ', data);

    for (var i = 0, length = connections.length; i < length; i++) {
        connections[i].emit('message', data);
    }
});

io.sockets.on('connection', function (socket) {
    connections.push(socket);
    console.log('[SERVER] New client connected');
});

console.log('[SERVER] Echo server started on 0.0.0.0:' + config.port);
