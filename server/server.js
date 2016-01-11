/*
 Change this to the port of your liking
 */
var port = 3002;

var redis_channel = 'argue';


var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');

io.on('connection', function (socket) {

  console.log("new client connected");

  var redis = new Redis();
  redis.subscribe(redis_channel);
 
  redis.on("message", function(channel, message) {
  	message = JSON.parse(message);
  	console.log(channel + ':' + message.event, message.data);
    socket.emit(channel + ':' + message.event, message.data);
  });
 
  socket.on('disconnect', function() {
  	console.log('client disconnected');

    redis.quit();
  });

});

http.listen(port, function(){
  console.log('listening on *:'+port);
});
