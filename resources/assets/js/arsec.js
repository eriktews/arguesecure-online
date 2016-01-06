var socket = io('http://192.168.10.10:3002');

$(window).on('beforeunload', function(){
    socket.close();
});	

socket.on('connect', function() {
	toastr.info('Connected');
});

socket.on("argue:App\\Events\\UserEvents\\UserConnected", function(message){
    toastr.info('New user');
});

socket.on("argue:App\\Events\\TreeEvents\\TreeCreated", function(message){
	toastr.info('A new tree was created:'+message.tree.name);
});

socket.on('disconnect', function() {
	toastr.info('Disconnected');
});
