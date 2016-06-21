/**
 * Created by Raylan on 16/06/2016.
 */
angular.module('app.controllers')
    
    .controller('ClientNewController',['$scope', 'Client', '$location', function ($scope, Client, $location) {
        
        $scope.projectNote = new Client();
        
        $scope.save = function () {
            if($scope.formClientNew.$valid){
                $scope.projectNote.$save().then(function () {
                    $location.path('/client')
                })
            }
        }
        
    }]);