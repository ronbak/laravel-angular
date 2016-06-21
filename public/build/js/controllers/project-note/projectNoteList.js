/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')
    
    .controller('ProjectNoteListController',['$scope', '$routeParams', 'ProjectNote', function ($scope, $routeParams, ProjectNote) {
        
        $scope.projectNotes = ProjectNote.query({idProject: $routeParams.idProject});
        
    }]);