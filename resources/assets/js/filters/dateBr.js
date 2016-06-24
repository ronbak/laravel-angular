/**
 * Created by Raylan on 24/06/2016.
 */
angular.module('app.filters').filter('dateBr', ['$filter', function ($filter) {
    return function (input) {
        return $filter('date')(input, 'dd/MM/yyyy');
    }
}]);


