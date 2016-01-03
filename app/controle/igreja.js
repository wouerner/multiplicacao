/**
 * @ngdoc function
 * @name yoExemploApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the yoExemploApp
 */
app.controller('IgrejaController', ['$scope', '$http', function ($scope, $http){
        $scope.igreja = {};
        $scope.igrejas = [];
        $scope.btnSalvar = 'save';

        $scope.getIgrejas = function(){
            $http.get('/igreja/igreja/all').
                success(function(data, status, headers, config) {
                    console.log(data);
                    $scope.igrejas = data;
                });
        }

        $scope.getIgrejas();
        console.log($scope.igrejas);

        $scope.save = function() {
                    $http({
                       method  :  'POST',
                       url     : $scope.btnSalvar == 'save' ? '/igreja/igreja/store' : '/igreja/igreja/update/'+ $scope.igreja.id,
                       data    : jQuery.param($scope.igreja) ,  // pass in data as strings
                       headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
                    }).
                    success(function(response){
                        $scope.igrejas = {};
                        location.reload();
                    }).
                    error(function(response){
                       alert('Incomplete Form');
                    });
                 }

        $scope.editar = function(id) {
                    $scope.igreja = $scope.igrejas[id];
                    $scope.btnSalvar = 'edit';
                 }

        $scope.delete = function(id) {
                       $http
                            .post('/igreja/igreja/destroy/'+id)
                            .success(function(data){
                              location.reload();
                            })
                            .error(function(data) {
                              alert('Unable to delete');
                           });
                }
  }]);
