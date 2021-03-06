/**
 * Created by Raylan on 17/06/2016.
 */
angular.module('app.services')

    .service('Project', ['$resource', 'appConfig', '$filter', '$httpParamSerializer', function ($resource, appConfig, $filter, $httpParamSerializer) {

        function transformData(data) {
            if(angular.isObject(data) && data.hasOwnProperty('due_date')){
                data.due_date = $filter('date')(data.due_date, 'yyyy-MM-dd');
                return $httpParamSerializer(data);
            }
            return data;
        }
        
        return $resource(appConfig.baseUrl + '/project/:idProject', {idProject: '@idProject'},{

            save: {
                method: 'POST',
                transformRequest: transformData()
            },

            get: {
                method: 'GET',
                transformResponse: function (data, headers) {
                    var o = appConfig.utils.transformResponse(data, headers);
                    if(angular.isObject(o) && o.hasOwnProperty('due_date')){
                        var arrayDate = o.due_date.split('-');
                        o.due_date = new Date(arrayDate[0], arrayDate[1], arrayDate[2]);
                    }
                    return o;
                }
            },

            update: {
                method: 'PUT',
                transformRequest: transformData()
            }

        });

    }]);