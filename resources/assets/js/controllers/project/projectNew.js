/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')

    .controller('ProjectNewController', ['$scope', 'Project', '$location', 'Client', 'appConfig', '$cookies',

        function ($scope, Project, $location, Client, appConfig, $cookies) {

            $scope.project = new Project();

            $scope.clients = Client.query();

            $scope.status = appConfig.project.status;

            $scope.save = function () {
                if ($scope.formProjectNew.$valid) {
                    $scope.project.owner_id = $cookies.getObject('user').id;
                    $scope.project.$save().then(function () {
                        $location.path('/project')
                    });
                }
            }

        }]);