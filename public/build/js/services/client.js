/**
 * Created by Raylan on 17/06/2016.
 */
angular.module('app.services')
    
    .service('Client', ['$resource', 'appConfig', function ($resource, appConfig) {
        
        return $resource(appConfig.baseUrl + '/client/:idClient', {idClient: '@id'},{
            
            update: {
                method: 'PUT'
            }

        });
        
    }]);