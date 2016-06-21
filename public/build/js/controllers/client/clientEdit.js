/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')

    .controller('ClientEditController', ['$scope', 'Client', '$location', '$routeParams',

        function ($scope, Client, $location, $routeParams) {

            $scope.projectNote = Client.get({idClient: $routeParams.idClient});

            $scope.save = function () {
                if ($scope.formClientNew.$valid) {
                    Client.update({idClient: $scope.projectNote.id}, $scope.projectNote, function () {
                        $location.path('/client')
                    });
                }
            }
            
        }]);