/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')
    .controller('ClientRemoveController', ['$scope', 'Client', '$location', '$routeParams',
        function ($scope, Client, $location, $routeParams) {
            $scope.client = new Client.get({id: $routeParams.id});
            $scope.remove = function () {
                $scope.client.$delete().then(function () {
                    $location.path('/client')
                })
            }
        }]);