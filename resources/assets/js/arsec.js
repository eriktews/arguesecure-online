/**
 * WebSocket
 */

//Change this to what suits you
var socket = io('http://192.168.10.10:3002');
var heart = laroute.route('heartbeat');
var heartrate = 30000;

//Connect to websocket
socket.on('connect', function() {
	socket.on('message', function (msg) {
      console.log(msg);
    });
});

/**
 * Tree Events
 */

socket.on("argue:App\\Events\\TreeEvents\\TreeSaved", function(message)
{
	if ( ! $('.argue-tree-container').length ) {
		return false;
	}

	if ( $('.argue-tree-vis').length ) {
		argueTreeVisRenderNode(message,'tree');
		return false;
	}

	if (message.tree.public == 0 && (message.tree.user_id != arsec.user.id) )  
	{
		argueDeleteTree(message.tree.id);
		
		toastr.info('A tree was hidden: '+message.tree.title);
		
		return false;
	}

	if (argueTreeExists(message.tree.id)) 
	{
		var tree = argueGetTreeByID(message.tree.id);
		
		argueUpdateTree(message.tree.id);
		
		if (message.tree.locked == 1 && !tree.data('tree-locked')) {
			toastr.info('A tree was locked: '+message.tree.title);
		} else {
			toastr.info('A tree was edited: '+message.tree.title);
		}
	}
	else 
	{
		argueCreateTree(message.tree.id);
		
		toastr.info('A tree was created: '+message.tree.title);
	}
});

socket.on("argue:App\\Events\\TreeEvents\\TreeDeleted", function(message)
{
	if (message.tree.public == 0 && (message.tree.user_id != arsec.user.id)) 
	{
		return false;
	}

	argueDeleteTree(message.tree.id);

	toastr.info(message.tree.title + ' tree has been deleted');
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
		toastr.error('Could not delete tree :(<br>A user might be editing a child node');
	});
});

/**
 * Risk Events
 */
socket.on("argue:App\\Events\\RiskEvents\\RiskSaved", function(message)
{
	argueTreeVisRenderNode(message,'risk');
});

socket.on("argue:App\\Events\\RiskEvents\\RiskDeleted", function(message)
{
	argueTreeVisRemoveNode(message, 'risk');
});

/**
 * Attack Events
 */
socket.on("argue:App\\Events\\AttackEvents\\AttackSaved", function(message)
{
	argueTreeVisRenderNode(message,'attack');
});

socket.on("argue:App\\Events\\AttackEvents\\AttackDeleted", function(message)
{
	argueTreeVisRemoveNode(message, 'attack');
});

/**
 * Defence Events
 */
socket.on("argue:App\\Events\\DefenceEvents\\DefenceSaved", function(message)
{
	argueTreeVisRenderNode(message,'defence');
});

socket.on("argue:App\\Events\\DefenceEvents\\DefenceDeleted", function(message)
{
	argueTreeVisRemoveNode(message, 'defence');
});

//Close socket on leaving the page
$(window).on('beforeunload', function()
{
    socket.close();
});

/**
 * Argue UI Manipulation - Tree View
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
		url: laroute.route('tree.ajax', { tree: id }),
		method: 'GET'
	})
	.done(function(data) {
		$(".argue-tree-container").append(data);
	})
	.fail(function() {
		toastr.error('Could not get new tree information :(');
	});
	
}

function argueDeleteTree(id)
{
	$('.argue-tree-wrapper[data-tree-id="'+id+'"]').remove();
	$('.site-menu-item[data-tree-id="'+id+'"]').remove();
}

function argueUpdateTree(id)
{
	var ajax_args = {
		headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
		url: laroute.route('tree.ajax', { tree: id }),
		method: 'GET'
	}
	$.ajax(ajax_args)
	.done(function(data) {
		$(argueGetTreeByID(id)).replaceWith(data);
	})
	.fail(function() {
		toastr.error('Could not get updated tree information :(');
	});
}

/**
 * Tree Visualisation
 */

function argueNodeExists(id,type)
{
	return !!argueNodeByID(id,type).length;
}

function argueNodeByID(id, type)
{
	return $('.argue-'+type+'-wrapper[data-'+type+'-id="'+id+'"]');
}

function argueTreeVisRemoveNode(message, type)
{
	var container = $('.argue-tree-vis');

	if ( ! $(container).length ) return true;

	var node = '.argue-' + type + '-wrapper[data-' + type + '-id="' + message[type].id +'"';
	var node_container = $(node).parent();
	if ($(node).length) {
		$(node).remove();
		if ($(node_container).children().length == 0 ) {
			$(node_container).remove();
		}
		toastr.info('A '+ type + ' has been deleted');
	}

}

function argueTreeVisRenderNode(message, type)
{
	var container = $('.argue-tree-vis');

	if ( ! $(container).length ) return true;

	if (message.tree.id != $(container).data('tree-id')) return true;

	if (argueNodeExists(message[type].id,type)) {
		var node = argueNodeByID(message[type].id,type);
		if (message[type].locked == 1 && !node.data(type+'-locked')) {
			toastr.info('A '+type+' was locked: '+message[type].title);
		} else if (message[type].locked == 0 && node.data(type+'-locked')) {
			toastr.info('A '+type+' was unlocked: '+message[type].title);
		} else {
			toastr.info('A '+type+' was edited: '+message[type].title);
		}
	}
	else {			
		toastr.info('A '+type+' was created: '+message[type].title);
	}
	argueTreeVisRenderNodeAjax(message[type].id,type, message.parent);
}

function argueTreeVisRenderNodeAjax(id, type, parent)
{
	//get Data
	var parameters = {};
	parameters[type] = id;
	$.ajax({
		headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
		url: laroute.route('node.ajax.'+type, parameters),
		method: 'GET'
	})
	//update tree
	.done(function(data) {
		var node_selector = '.argue-'+type+'-wrapper[data-'+type+'-id='+id+']';
		if ($(node_selector).length) {
			$(node_selector).each(function(i, node) {
				$(this).replaceWith(data);
			});
		}
		else {
			var parent_selector = '.argue-'+parent.type+'-wrapper[data-'+parent.type+'-id='+parent.id+']';
			if ($(parent_selector).length) {
				if (! $(parent_selector).children('ul').length) {
					$(parent_selector).append('<ul></ul>');
				}
				var ul = $(parent_selector).children('ul');
				$(ul).append(data);
			}
		}

	})
	.fail(function() {
		toastr.error('Could not get updated node information :(');
	});
}

$('.argue-tree-vis').on('click','.argue-tree-vis-leaf', function(event) { 
	var elem = $(this);
	if ($(elem).hasClass('argue-node-body-open')) {
		$(elem).removeClass('argue-node-body-open');
		$(elem).children('.argue-node-body').velocity("slideUp", { duration: 300 });
	}
	else {
		$(elem).addClass('argue-node-body-open');
		$(elem).children('.argue-node-body').velocity("slideDown", { duration: 300 });
	}
});

$('.argue-tree-vis').on('click', '.argue-node-action-toggle', function(event) { 
	var elem = $(this);
	if ($(elem).hasClass('argue-node-buttons-open')) {
		$(elem).removeClass('argue-node-buttons-open');
		$(elem).parent().siblings('.argue-node-actions').velocity("slideUp", { duration: 300 });
	}
	else {
		$(elem).addClass('argue-node-buttons-open');
		$(elem).parent().siblings('.argue-node-actions').velocity("slideDown", { duration: 300 });
	}
	event.stopPropagation();

});

$('.argue-node-action-delete-form').submit(function(event) 
{
	event.preventDefault();

	var tree = $(this).closest('.argue-tree-vis-leaf');
	var type = $(this).data('type');
	var id = $(this).data('id');
	var parameters = {};
	parameters[type] = id;

	$.ajax({
        headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') },
		url: laroute.route(type+'.destroy', parameters ),
		data: {_method: 'delete'},
		method: 'POST'
	})
	.done(function() {
	})
	.fail(function(request, error, exception) {
		toastr.error('Could not delete tree :(<br>A user might be editing a child node');
	});
});

$('.argue-tree-vis').on('click', '.argue-node-action', function(event) { 
	event.stopPropagation();
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
