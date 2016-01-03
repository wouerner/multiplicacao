/**
 * @ngdoc function
 * @name yoExemploApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the yoExemploApp
 */
app.controller('DiscipuloListarController', ['$scope', '$http',"NgTableParams", function ($scope, $http, NgTableParams){

        $scope.tableParams = new NgTableParams(
            {page:1, counts: []},
            {
                getData: function($defer, params) {
                    var filter = params.filter();
                    var count = params.count();

                    return  $http({url: '/discipulo/discipulo/index2',
                              data: jQuery.param({filter: filter, count: count, page: params.page()}), method: "POST",
                              headers : { 'Content-Type': 'application/x-www-form-urlencoded' }
                        }).
                        then(function(data) {
                                params.total(data.data.total);
                                console.log(data.data.total);
                                return data.data.dados;
                        });
            }
        });

  }]);
