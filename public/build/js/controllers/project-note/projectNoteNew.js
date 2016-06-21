/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')

    .controller('ProjectNoteNewController', ['$scope', '$routeParams', 'ProjectNote', '$location',

        function ($scope, $routeParams, ProjectNote, $location) {

            $scope.projectNote = new ProjectNote();

            $scope.projectNote.project_id = $routeParams.idProject;

            $scope.save = function () {
                if ($scope.formProjectNoteNew.$valid) {
                    $scope.projectNote.$save({idProject: $routeParams.idProject}).then(function () {
                        $location.path('/project/' + $routeParams.idProject + '/note')
                    })
                }
            }

        }]);