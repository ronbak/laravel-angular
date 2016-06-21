/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')
    .controller('HomeController',['$scope', '$cookies', function ($scope, $cookies) {
        console.log($cookies.getObject('user').email);
    }]);