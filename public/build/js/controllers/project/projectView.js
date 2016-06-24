/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')
    
    .controller('ProjectNoteViewController', ['$scope', 'ProjectNote', '$routeParams',
        
        function ($scope, ProjectNote, $routeParams) {
            
            $scope.projectNote = new ProjectNote.get({idProject: $routeParams.idProject, idNote: $routeParams.idNote});
            
        }]);