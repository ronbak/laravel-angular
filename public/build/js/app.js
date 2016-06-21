/**
 * Created by Raylan on 16/06/2016.
 */
var app = angular.module('app', ['ngRoute', 'angular-oauth2', 'app.controllers', 'app.services']);

angular.module('app.controllers', ['ngMessages', 'angular-oauth2']);

angular.module('app.services', ['ngResource']);

app.provider('appConfig', function () {
    var config = {
        baseUrl: 'http://localhost:8080'
    };
    return {
        config: config,
        $get: function () {
            return config;
        }
    }
});

app.config(['$routeProvider', '$httpProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider',

    function ($routeProvider, $httpProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {

        $httpProvider.defaults.transformResponse = function (data, headers) {

            var headersGetter = headers();

            if(headersGetter['content-type'] == 'application/json' || headersGetter['content-type'] == 'text/json'){

                var dataJason = JSON.parse(data);

                if(dataJason.hasOwnProperty('data')){

                    dataJason = dataJason.data;

                }

                return dataJason;

            }

            return data;

        };

        $routeProvider

            .when('/login', {
                templateUrl: 'build/views/login.html',
                controller: 'LoginController'
            })
            .when('/home', {
                templateUrl: 'build/views/home.html',
                controller: 'HomeController'
            })
            .when('/client', {
                templateUrl: 'build/views/client/list.html',
                controller: 'ClientListController'
            })
            .when('/client/new', {
                templateUrl: 'build/views/client/new.html',
                controller: 'ClientNewController'
            })

            .when('/client/:idClient/view', {
                templateUrl: 'build/views/client/view.html',
                controller: 'ClientViewController'
            })

            .when('/client/:idClient/edit', {
                templateUrl: 'build/views/client/edit.html',
                controller: 'ClientEditController'
            })

            .when('/client/:idClient/remove', {
                templateUrl: 'build/views/client/remove.html',
                controller: 'ClientRemoveController'
            })

            .when('/project/:idProject/note', {
                templateUrl: 'build/views/project-note/list.html',
                controller: 'ProjectNoteListController'
            })

            .when('/project/:idProject/note/new', {
                templateUrl: 'build/views/project-note/new.html',
                controller: 'ProjectNoteNewController'
            })

            .when('/project/:idProject/note/:idNote/view', {
                templateUrl: 'build/views/project-note/view.html',
                controller: 'ProjectNoteViewController'
            })

            .when('/project/:idProject/note/:idNote/edit', {
                templateUrl: 'build/views/project-note/edit.html',
                controller: 'ProjectNoteEditController'
            })

            .when('/project/:idProject/note/:idNote/remove', {
                templateUrl: 'build/views/project-note/remove.html',
                controller: 'ProjectNoteRemoveController'
            });

        OAuthProvider.configure({
            baseUrl: appConfigProvider.config.baseUrl,
            clientId: 'appid1',
            clientSecret: 'secret', // optional
            grantPath: 'oauth/access_token'
        });

        OAuthTokenProvider.configure({
            name: 'token',
            options: {
                secure: false
            }
        })
    }]);

app.run(['$rootScope', '$window', 'OAuth', function ($rootScope, $window, OAuth) {

    $rootScope.$on('oauth:error', function (event, rejection) {

        if ('invalid_grant' === rejection.data.error) {
            return;
        }

        if ('invalid_token' === rejection.data.error) {
            return OAuth.getRefreshToken();
        }

        return $window.location.href = '/login?error_reason=' + rejection.data.error;

    });

}]);