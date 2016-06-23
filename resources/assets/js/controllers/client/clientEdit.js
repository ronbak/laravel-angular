/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')

    .controller('ClientEditController', ['$scope', 'Client', '$location', '$routeParams',

        function ($scope, Client, $location, $routeParams) {

            $scope.client = Client.get({idClient: $routeParams.idClient});

            $scope.save = function () {
                if ($scope.formClientEdit.$valid) {
                    Client.update({idClient: $scope.client.id}, $scope.client, function () {
                        $location.path('/client')
                    });
                }
            }
            
        }]);