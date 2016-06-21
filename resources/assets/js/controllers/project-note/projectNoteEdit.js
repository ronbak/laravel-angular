/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')

    .controller('ProjectNoteEditController', ['$scope', 'ProjectNote', '$location', '$routeParams',

        function ($scope, ProjectNote, $location, $routeParams) {

            $scope.projectNote = ProjectNote.get({idProject: $routeParams.idProject, idNote: $routeParams.idNote});

            $scope.save = function () {
                if ($scope.formProjectNoteEdit.$valid) {
                    ProjectNote.update({idProject: $routeParams.idProject, idNote: $routeParams.idNote}, $scope.projectNote, function () {
                        $location.path('/project/' + $routeParams.idProject + '/note')
                    });
                }
            }
            
        }]);