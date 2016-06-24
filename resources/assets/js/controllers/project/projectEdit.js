/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')

    .controller('ProjectEditController', ['$scope', 'Project', '$location', 'Client', 'appConfig', '$cookies', '$routeParams',

        function ($scope, Project, $location, Client, appConfig, $cookies, $routeParams) {

            $scope.project = Project.get({idProject: $routeParams.idProject});

            $scope.clients = Client.query();

            $scope.status = appConfig.project.status;

            $scope.save = function () {
                if ($scope.formProjectEdit.$valid) {
                    $scope.project.owner_id = $cookies.getObject('user').id;
                    Project.update({id: $scope.project.id}, $scope.project, function () {
                        $location.path('/project')
                    });
                }
            }

        }]);