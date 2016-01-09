/**
 * WebSocket
 */

//Change this to what suits you
var socket = io('http://192.168.10.10:3002');

//Connect to websocket
socket.on('connect', function() {
	socket.on('message', function (msg) {
      console.log(msg);
    });
});

/**
 * Tree Create and Edit
 */

socket.on("argue:App\\Events\\TreeEvents\\TreeSaved", function(message)
{
	if (message.tree.public == 0) {
		toastr.info('A tree was hidden: '+message.tree.title);
		argueDeleteTree(message.tree.id);
	} else {

		if (argueTreeExists(message.tree.id)) {
			toastr.info('A tree was edited: '+message.tree.title);
			argueUpdateTree(message.tree.id);
		}
		else {
			toastr.info('A tree was created: '+message.tree.title);
			argueCreateTree(message.tree.id);
		}
	}
});

socket.on("argue:App\\Events\\TreeEvents\\TreeDeleted", function(message)
{
	toastr.info(message.tree.title + ' tree has been deleted');

	argueDeleteTree(message.tree.id);
});

$('.argue-tree-action-delete-form').submit(function(event) 
{
	event.preventDefault();

	var tree = $(this).closest('.argue-tree').data('tree-id');

	$.ajax({
        headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
		url: laroute.route('tree.destroy', { tree: tree }),
		data: {_method: 'delete'},
		method: 'POST'
	})
	.done(function() {
		$('.argue-tree-wrapper[data-tree-id="'+tree+'"]').remove();
	})
	.fail(function() {
		toastr.danger('Could not delete tree :(');
	});
});

//Close socket on leaving the page
$(window).on('beforeunload', function()
{
    socket.close();
});

/**
 * Argue UI Manipulation
 */

function argueTreeExists(id)
{
	return !!argueGetTreeByID(id).length;
}

function argueGetTreeByID(id)
{
	return $('.argue-tree[data-tree-id="'+id+'"]');
}

function argueGetTreeId(tree)
{
	return tree.closest('.argue-tree').data('tree-id');
}

function argueCreateTree(id)
{
	$.ajax({
        headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
		url: laroute.route('tree.ajax', { id: id }),
		method: 'GET'
	})
	.done(function(data) {
		$(".argue-tree-container").append(data);
	})
	.fail(function() {
		toastr.danger('Could not get new tree information :(');
	});
	
}

function argueDeleteTree(id)
{
	$('.argue-tree-wrapper[data-tree-id="'+id+'"]').remove();
}

function argueUpdateTree(id)
{
	$.ajax({
        headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
		url: laroute.route('tree.ajax', { id: id }),
		method: 'GET'
	})
	.done(function(data) {
		$('.argue-tree-wrapper[data-tree-id="'+id+'"]').append(data);
	})
	.fail(function() {
		toastr.danger('Could not get updated tree information :(');
	});
}
