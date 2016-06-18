/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')
    .controller('ClientEditController', ['$scope', 'Client', '$location', '$routeParams',
        function ($scope, Client, $location, $routeParams) {
            $scope.client = new Client.get({id: $routeParams.id});
            $scope.save = function () {
                if ($scope.formClientNew.$valid) {
                    Client.update({id: $scope.client.id}, $scope.client, function () {
                        $location.path('/client')
                    });
                    $scope.client.$save().then(function () {
                        $location.path('/client')
                    })
                }
            }
        }]);