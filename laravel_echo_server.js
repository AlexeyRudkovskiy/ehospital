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

    // is private message
    var splittedChannelName = channel.split('::');
    var receivers = [];
    if (splittedChannelName.length == 2) {
        if (!isNaN(splittedChannelName[0]) && Number(splittedChannelName[0]) > 0) {
            splittedChannelName[0] = Number(splittedChannelName[0]);
            receivers = connections.filter(function (item) {
                return item.id === splittedChannelName[0] && item.connected;
            });

            data.user = {
                id: splittedChannelName[0]
            };
            data.channel = splittedChannelName[1];
        } else {
            receivers = connections;
        }
    } else {
        receivers = connections;
    }

    console.log('[SERVER] New event. Receivers: ' + receivers.length + '. Event data: ', data);

    for (var i = 0, length = receivers.length; i < length; i++) {
        receivers[i].emit('message', data);
    }
});

io.sockets.on('connection', function (socket) {
    connections.push(socket);
    console.log('[SERVER] New client connected');

    socket.on('register', function (data) {
        console.log(data);

        if (typeof data.id === "undefined") {
            console.log("[SERVER] Bad registration credentials")
            return -1;
        }

        console.log("[SERVER] Registered. ID: " + data.id)
        socket.id = data.id;
    });
});

console.log('[SERVER] Echo server started on 0.0.0.0:' + config.port);
