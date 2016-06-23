/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')
    
    .controller('ClientRemoveController', ['$scope', 'Client', '$location', '$routeParams',
        
        function ($scope, Client, $location, $routeParams) {
            
            $scope.client = Client.get({idClient: $routeParams.idClient});
            
            $scope.remove = function () {
                $scope.client.$delete({idClient: $routeParams.idClient}).then(function () {
                    $location.path('/client')
                })
            }
            
        }]);