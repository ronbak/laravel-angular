/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')
    
    .controller('ClientListController',['$scope', 'Client', function ($scope, Client) {
        
        $scope.clients = Client.query();
        
    }]);