(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://argue.app',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\AuthController@getLogin"},{"host":null,"methods":["POST"],"uri":"login","name":"login-post","action":"App\Http\Controllers\Auth\AuthController@postLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home","action":"App\Http\Controllers\TreeController@index"},{"host":null,"methods":["POST"],"uri":"ajax\/node\/startUpdate","name":"node.ajax.startUpdate","action":"App\Http\Controllers\NodeController@nodeStartUpdate"},{"host":null,"methods":["POST"],"uri":"ajax\/node\/stopUpdate","name":"node.ajax.stopUpdate","action":"App\Http\Controllers\NodeController@nodeStartUpdate"},{"host":null,"methods":["GET","HEAD"],"uri":"ajax\/tree\/{tree}","name":"tree.ajax","action":"App\Http\Controllers\TreeController@ajax"},{"host":null,"methods":["GET","HEAD"],"uri":"ajax\/node\/tree\/{tree}","name":"node.ajax.tree","action":"App\Http\Controllers\NodeController@nodeTreeVis"},{"host":null,"methods":["GET","HEAD"],"uri":"ajax\/node\/risk\/{risk}","name":"node.ajax.risk","action":"App\Http\Controllers\NodeController@nodeTreeVis"},{"host":null,"methods":["GET","HEAD"],"uri":"ajax\/node\/attack\/{attack}","name":"node.ajax.attack","action":"App\Http\Controllers\NodeController@nodeTreeVis"},{"host":null,"methods":["GET","HEAD"],"uri":"ajax\/node\/defence\/{defence}","name":"node.ajax.defence","action":"App\Http\Controllers\NodeController@nodeTreeVis"},{"host":null,"methods":["DELETE"],"uri":"risk\/{risk}","name":"risk.destroy","action":"App\Http\Controllers\RiskController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"tree\/{tree}\/risk\/create","name":"risk.create","action":"App\Http\Controllers\RiskController@create"},{"host":null,"methods":["POST"],"uri":"tree\/{tree}\/risk","name":"risk.store","action":"App\Http\Controllers\RiskController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"tree\/{tree}\/risk\/{risk}","name":"risk.show","action":"App\Http\Controllers\RiskController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"tree\/{tree}\/risk\/{risk}\/edit","name":"risk.edit","action":"App\Http\Controllers\RiskController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"tree\/{tree}\/risk\/{risk}","name":"risk.update","action":"App\Http\Controllers\RiskController@update"},{"host":null,"methods":["DELETE"],"uri":"attack\/{attack}","name":"attack.destroy","action":"App\Http\Controllers\AttackController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"risk\/{risk}\/attack\/create","name":"attack.create","action":"App\Http\Controllers\AttackController@create"},{"host":null,"methods":["POST"],"uri":"risk\/{risk}\/attack","name":"attack.store","action":"App\Http\Controllers\AttackController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"risk\/{risk}\/attack\/{attack}","name":"attack.show","action":"App\Http\Controllers\AttackController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"risk\/{risk}\/attack\/{attack}\/edit","name":"attack.edit","action":"App\Http\Controllers\AttackController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"risk\/{risk}\/attack\/{attack}","name":"attack.update","action":"App\Http\Controllers\AttackController@update"},{"host":null,"methods":["DELETE"],"uri":"defence\/{defence}","name":"defence.destroy","action":"App\Http\Controllers\DefenceController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"attack\/{attack}\/defence\/create","name":"defence.create","action":"App\Http\Controllers\DefenceController@create"},{"host":null,"methods":["POST"],"uri":"attack\/{attack}\/defence","name":"defence.store","action":"App\Http\Controllers\DefenceController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"attack\/{attack}\/defence\/{defence}","name":"defence.show","action":"App\Http\Controllers\DefenceController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"attack\/{attack}\/defence\/{defence}\/edit","name":"defence.edit","action":"App\Http\Controllers\DefenceController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"attack\/{attack}\/defence\/{defence}","name":"defence.update","action":"App\Http\Controllers\DefenceController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"tree","name":"tree.index","action":"App\Http\Controllers\TreeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"tree\/create","name":"tree.create","action":"App\Http\Controllers\TreeController@create"},{"host":null,"methods":["POST"],"uri":"tree","name":"tree.store","action":"App\Http\Controllers\TreeController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"tree\/{tree}","name":"tree.show","action":"App\Http\Controllers\TreeController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"tree\/{tree}\/edit","name":"tree.edit","action":"App\Http\Controllers\TreeController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"tree\/{tree}","name":"tree.update","action":"App\Http\Controllers\TreeController@update"},{"host":null,"methods":["DELETE"],"uri":"tree\/{tree}","name":"tree.destroy","action":"App\Http\Controllers\TreeController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"heartbeat","name":"heartbeat","action":"App\Http\Controllers\HeartbeatController@beat"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\AuthController@getLogout"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

