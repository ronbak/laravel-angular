/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')
    
    .controller('ProjectNoteRemoveController', ['$scope', 'ProjectNote', '$location', '$routeParams',
        
        function ($scope, ProjectNote, $location, $routeParams) {

            $scope.projectNote = ProjectNote.get({idProject: $routeParams.idProject, idNote: $routeParams.idNote});
            
            $scope.remove = function () {
                $scope.projectNote.$delete({idProject: $routeParams.idProject, idNote: $routeParams.idNote}).then(function () {
                    $location.path('/project/' + $routeParams.idProject + '/note')
                })
            }
            
        }]);