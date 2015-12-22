<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Argue Secure</title>
</head>
<body>

ARGUE SECURE
@yield('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdn.socket.io/socket.io-1.3.7.js"></script>
<script>
var socket = io('http://192.168.33.10:3002');
$(window).on('beforeunload', function(){
    socket.close();
});	
socket.on('connect', function() {
	$('body').append('<p>connected...</p>');
});
socket.on("argue:App\\Events\\UserConnected", function(message){
	console.log('a user has entered this channel -using a nice MESSAGE');
	console.log(message);
    $('body').append('New user');
});
socket.on('disconnect', function() {
	$('body').append('<p>disconnected...</p>');
});
</script>
</body>
</html>