/**
 * WebSocket
 */

//Change this to what suits you
var socket = io(websocketip);
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
	if ( ! $('.argue-tree-container').length && !$('.argue-tree-vis').length ) {
		return false;
	}

	if ( $('.argue-tree-vis').length ) {
		argueTreeVisRenderNode(message,'tree');
		return false;
	}

	if (message.tree.public == 0 && (message.tree.user_id != arsec.user.id) )  
	{
		argueDeleteTree(message.tree.id);
		
		toastr.info(message['tree'].updated_by.name + ' has hidden Assessment: '+message.tree.title);
		
		return false;
	}

	if (argueTreeExists(message.tree.id)) 
	{
		var tree = argueGetTreeByID(message.tree.id);
		
		argueUpdateTree(message.tree.id);
		
		if (message.tree.locked == 1 && !tree.data('tree-locked')) {
			toastr.info(message['tree'].updated_by.name + ' has locked Assessment: '+message.tree.title);
		} else {
			toastr.info(message['tree'].updated_by.name + ' has unlocked Assessment: '+message.tree.title);
		}
	}
	else 
	{
		argueCreateTree(message.tree.id);
		
		toastr.info(message['tree'].updated_by.name + ' has created Assessment: ' + message.tree.title);
	}
});

socket.on("argue:App\\Events\\TreeEvents\\TreeDeleted", function(message)
{
	if (message.tree.public == 0 && (message.tree.user_id != arsec.user.id)) 
	{
		return false;
	}

	var tree = $('.argue-tree').data('tree-id');

	if (tree == message.tree.id) {
		alert("This tree has been deleted and you will be redirected to the assessment list");
		window.location = laroute.route('home');
	}

	argueDeleteTree(message.tree.id);

	toastr.info(message['tree'].updated_by.name + ' has deleted Assessment: ' + message.tree.title);
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
		toastr.error('Could not delete Assessment :(<br>A user might be editing a child node');
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
		toastr.error('Could not get new Assessment information :(');
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
		toastr.error('Could not get updated Assessment information :(');
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
	if ($(node).length) {
		$(node).each(function (i) {
			var node_container = $(node).parent();
			$(this).remove();
			if ($(node_container).children().length == 0 ) {
				$(node_container).remove();
			}
		});
	}
	toastr.info(message[type].updated_by.name + ' has deleted '+ type + ': '+message[type].title);
	updateTags();

}

function argueTreeVisRenderNode(message, type)
{
	var container = $('.argue-tree-vis');

	if ( ! $(container).length ) return true;

	if (message.tree.id != $(container).data('tree-id')) return true;

	if (argueNodeExists(message[type].id,type)) {
		var node = argueNodeByID(message[type].id,type);
		if (message[type].locked == 1 && !node.data(type+'-locked')) {
			toastr.info(message[type].updated_by.name + ' has locked '+type+': '+message[type].title);
			if (message[type].updated_by.name == arsec.user.name) {
				return;
			}
		} else if (message[type].locked == 0 && node.data(type+'-locked')) {
			toastr.info(message[type].updated_by.name + ' has unlocked '+type+': '+message[type].title);
		} else {
			toastr.info(message[type].updated_by.name + ' has edited '+type+': '+message[type].title);
		}
	}
	else {			
		toastr.info(message[type].updated_by.name + ' has created '+type+': '+message[type].title);
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
			if (parent.id.constructor !== Array) {
				parent.id = [parent.id];
			}
			$.each(parent.id, function(i, value) {
				var parent_selector = '.argue-'+parent.type+'-wrapper[data-'+parent.type+'-id='+value+']';
				if ($(parent_selector).length) {
					if (! $(parent_selector).children('ul').length) {
						$(parent_selector).append('<ul></ul>');
					}
				}
				var ul = $(parent_selector).children('ul');
				$(ul).append(data);
			});
		}
		updateTags();
	})
	.fail(function() {
		toastr.error('Could not get updated node information :(');
	});
}

$('.argue-tree-vis').on('click','.argue-node-description-toggle', function(event) { 
	var elem = $(this).closest('.argue-tree-vis-leaf');
	if ($(elem).hasClass('argue-node-description-open')) {
		$(elem).removeClass('argue-node-description-open');
		$(elem).find('.argue-node-body .node-description-wrapper').velocity("slideUp", { duration: 300 });
	}
	else {
		$(elem).addClass('argue-node-description-open');
		$(elem).find('.argue-node-body .node-description-wrapper').velocity("slideDown", { duration: 300 });
	}
});

$('.argue-tree-vis').on('click','.argue-node-notes-toggle', function(event) { 
	var elem = $(this).closest('.argue-tree-vis-leaf');
	if ($(elem).hasClass('argue-node-notes-open')) {
		$(elem).removeClass('argue-node-notes-open');
		$(elem).find('.argue-node-body .node-notes-wrapper').velocity("slideUp", { duration: 300 });
	}
	else {
		$(elem).addClass('argue-node-notes-open');
		$(elem).find('.argue-node-body .node-notes-wrapper').velocity("slideDown", { duration: 300 });
	}
});

$('.argue-tree-vis').on('click', '.argue-node-action-toggle', function(event) { 
	var elem = $(this);
	if ($(elem).hasClass('argue-node-buttons-open')) {
		$(elem).removeClass('argue-node-buttons-open');
		$(elem).closest('.argue-tree-vis-leaf').find('.argue-node-actions').velocity("slideUp", { duration: 300 });
	}
	else {
		$(elem).addClass('argue-node-buttons-open');
		$(elem).closest('.argue-tree-vis-leaf').find('.argue-node-actions').velocity("slideDown", { duration: 300 });
	}
	event.stopPropagation();
});

$('.argue-tree-vis').on('click', '.argue-node-collapse-toggle', function(event) {collapseNode(event, this)});
$('.argue-tree-vis').on('dblclick', '.argue-tree-vis-leaf', function(event) {collapseNode(event, this)});


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

function collapseNode(event, target) { 
	var elem = $(target).closest('.argue-leaf-wrapper');
	if ($(elem).hasClass('argue-node-collapsed')) {
		$(elem).removeClass('argue-node-collapsed');
		$(elem).find('.argue-node-collapse-toggle').toggleClass('fa-minus').toggleClass('fa-plus');
		$(elem).children('.argue-leaf-children').velocity("slideDown", { duration: 300 });
	}
	else {
		$(elem).addClass('argue-node-collapsed');
		$(elem).find('.argue-node-collapse-toggle').toggleClass('fa-minus').toggleClass('fa-plus');
		$(elem).children('.argue-leaf-children').velocity("slideUp", { duration: 300 });
	}
	event.stopPropagation();
}

/**
 * Span <-> Input switching
 */
$('.argue-tree-vis').on("click", '.input-switch > span', function() {
	var leaf = $(this).closest('.argue-tree-vis-leaf');
	var type = $(leaf).data('type');
	var id = $(leaf).data(type+'-id');
 	startUpdate(id,type,this);  	
});
$('.argue-tree-vis').on("blur", '.input-switch > input', function() {
	var leaf = $(this).closest('.argue-tree-vis-leaf');
	var type = $(leaf).data('type');
	var id = $(leaf).data(type+'-id');
 	stopUpdate(id,type,this);  	 	
}).on('keydown', '.input-switch > input', function(e) {
  if (e.which==13) {
  	var leaf = $(this).closest('.argue-tree-vis-leaf');
	var type = $(leaf).data('type');
	var id = $(leaf).data(type+'-id');
    e.preventDefault();
 	stopUpdate(id,type,this);  	 	
  }
});

function startUpdate(id, type, element)
{
	$.ajax({
  		type: 'POST',
		headers: { 'X-CSRF-Token' : $('[name="csrf-token"]').attr('content') },
		dataType: "json",
		data: {
			type: type,
			id: id
		},
		url: laroute.route('node.ajax.startUpdate')
	})
	.done(function() {
		$(element).hide().siblings("input").val($(element).text()).show().focus().select();
	})
	.fail(function() {

	});
}

function stopUpdate(id, type, element)
{
	showLoader(element);
	$.ajax({
  		type: 'POST',
		headers: { 'X-CSRF-Token' : $('[name="csrf-token"]').attr('content') },
		dataType: "json",
		data: {
			type: type,
			id: id,
			field: $(element).attr('name'),
			value: $(element).val()
		},
		url: laroute.route('node.ajax.stopUpdate')
	})
 	.done(function() {
		$(element).hide().siblings("span").text($(element).val()).show();
	})
	.fail(function() {
		$(element).hide().val($(element).siblings("span").text()).siblings("span").show();
		toastr.error('Could not update Node :(<br>Try the edit page instead');
	})
	.always(function() {
		hideLoader($(element));
	});

}

function showLoader(element)
{
	$(element).closest('.input-switch').children('.loading').show();
}

function hideLoader(element)
{
	$(element).closest('.input-switch').children('.loading').hide();
}

/**
 * Tags section
 */

var filters = [];

$('body').on('click','.node-tag', function(event) {
	var tag_id = $(this).data('tag-id');
	$('.site-menu-item-custom').each(function() {
		if ($(this).data('tag-id') == tag_id)
			$(this).toggleClass('site-menu-item-custom-selected');
	});
	filterTag(tag_id);
});

$('.clear-filters').click(function(event) {
	clearFilters();
});

function filterTag(id)
{
	if (filters.indexOf(id) == -1) filters.push(id);
	else filters.splice(filters.indexOf(id),1);
	filterTags();
}

function clearFilters()
{
	filters = [];
	$('.site-menu-item-custom').removeClass('site-menu-item-custom-selected');
	filterTags();
}

function updateTags()
{
	var tags = {};
	var menu_tags = {};
	$('.argue-tree-vis-leaf').each(function() {
		$(this).find('.node-tag').each(function() {
			if (!tags.hasOwnProperty($(this).data('tag-id'))) tags[$(this).data('tag-id')]={slug: $(this).data('tag-slug'), text: $(this).text()};
		});
	});

	$('.site-menu .node-tag').each(function() {
		if (!$(this).data('tag-slug')) return true;
		menu_tags[$(this).data('tag-id')]=$(this).data('tag-slug');
	});

	console.log(tags);
	console.log(menu_tags);
	$('.site-menu .node-tag').each(function() {
		if (!$(this).data('tag-slug')) return true;
		if (!($(this).data('tag-id') in tags)) {console.log(this); $(this).remove()};
	});

	$.each(tags, function(index, value) {
		if ( !(index in menu_tags)) {
			var added=false;
			$('.site-menu .node-tag').each(function() {
				if (!$(this).data('tag-slug')) return true;

				if ($(this).data('tag-slug').localeCompare(value.slug) == 1 && !added) {
					var newtag = $('.site-menu .empty-tag').clone();
					$(newtag).removeClass('empty-tag').insertBefore(this).data('tag-id', index).data('tag-slug',value.slug).find('.site-menu-title').text(value.text);
					added=true;
				}
			});
			if (!added) {
				var newtag = $('.site-menu .empty-tag').clone();
				$(newtag).removeClass('empty-tag').insertBefore($('.site-menu .empty-tag')).data('tag-id', index).data('tag-slug',value.slug).find('.site-menu-title').text(value.text);
			}	
		}
	});

}

function filterTags()
{
	$('.argue-tree-vis-leaf').each(function() {
		$(this).removeClass('filtered');
		var filter = false;
		$(this).find('.node-tag').each(function() {
			for (var i = filters.length - 1; i >= 0; i--) {
				if ($(this).data('tag-id') == filters[i])
				{
					filter = true;
					return false;
				}
			}
		});
		if (filter) 
		{
			$(this).addClass('filtered');
		}
	});
}

/**
 * Heartbeat
 */

function heartbeat()
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
}
heartbeat();