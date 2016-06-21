/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')
    
    .controller('ClientViewController', ['$scope', 'Client', '$routeParams',
        
        function ($scope, Client, $routeParams) {
            
            $scope.projectNote = new Client.get({idClient: $routeParams.idClient});
            
        }]);