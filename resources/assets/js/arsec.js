/**
 * WebSocket
 */

//Change this to what suits you
var socket = io('http://192.168.10.10:3002');
var heart = laroute.route('heartbeat');
var heartrate = 31000;

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
	console.log(message);

	if ( ! $('.argue-tree-container').length ) return true;

	if (message.tree.public == 0) {
		toastr.info('A tree was hidden: '+message.tree.title);
		argueDeleteTree(message.tree.id);
		return false;
	}

	if (argueTreeExists(message.tree.id)) {
		var tree = argueGetTreeByID(message.tree.id);
		if (message.tree.locked == 1 && !tree.data('tree-locked')) {
			toastr.info('A tree was locked: '+message.tree.title);
		} else if (message.tree.locked == 0 && tree.data('tree-locked')) {
			toastr.info('A tree was unlocked: '+message.tree.title);
		} else {
			toastr.info('A tree was edited: '+message.tree.title);
		}
		argueUpdateTree(message.tree.id);
	}
	else {
		toastr.info('A tree was created: '+message.tree.title);
		argueCreateTree(message.tree.id);
	}
});

socket.on("argue:App\\Events\\TreeEvents\\TreeDeleted", function(message)
{
	if ( ! $('.argue-tree-container').length ) return true;

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
	.fail(function(request, error, exception) {
		console.log(error, exception);
		toastr.error('Could not delete tree :(<br>A user might be editing a child node');
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
	return $('.argue-tree-wrapper[data-tree-id="'+id+'"]');
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
	var ajax_args = {
		headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
		url: laroute.route('tree.ajax', { tree: id }),
		method: 'GET'
	}
	if ($('.argue-tree-vis').length) {
		ajax_args.url = laroute.route('node.ajax', {tree: id})
	}
	$.ajax(ajax_args)
	.done(function(data) {
		$(argueGetTreeByID(id)).replaceWith(data);
	})
	.fail(function() {
		toastr.danger('Could not get updated tree information :(');
	});
}

/**
 * Tree Visualisation js
 */

$('.argue-tree-vis-leaf').click(function(event) { 
	var elem = $(this);
	if ($(elem).hasClass('argue-tree-buttons-open')) {
		$(elem).removeClass('argue-tree-buttons-open');
		$(elem).children('.argue-tree-actions').velocity("slideUp", { duration: 300 });
	}
	else {
		$(elem).addClass('argue-tree-buttons-open');
		$(elem).children('.argue-tree-actions').velocity("slideDown", { duration: 300});
	}
});

/**
 * Heartbeat
 */

(function heartbeat()
{
	var data = null;
	if ( arsec.hasOwnProperty("model") ) {
		data = {
			arsec_update_id: arsec.model.id,
			arsec_update_type: arsec.model.type
		};
	}
    $.ajax({ 
    	dataType: "json",
    	data: data,
    	url: heart
    }).
    always(function() {
    	setTimeout( heartbeat, heartrate );
    });
})(laroute);
