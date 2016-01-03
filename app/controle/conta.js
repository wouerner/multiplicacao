/**
 * @ngdoc function
 * @name yoExemploApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the yoExemploApp
 */
app.controller('ContaController', ['$scope', '$http', function ($scope, $http){
        $scope.conta = {};
        $scope.contas = [];
        $scope.btnSalvar = 'save';

        $scope.getContas = function(){
            $http.get('/oferta/conta/all').
                success(function(data, status, headers, config) {
                    console.log(data);
                    $scope.contas = data;
                });
        }

        $scope.getContas();
        console.log($scope.contas);

        $scope.save = function() {
                    $http({
                       method  :  'POST',
                       url     : $scope.btnSalvar == 'save' ? '/oferta/conta/store' : '/oferta/conta/update/'+ $scope.conta.id,
                       data    : jQuery.param($scope.conta) ,  // pass in data as strings
                       headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
                    }).
                    success(function(response){
                        $scope.contas = {};
                        location.reload();
                    }).
                    error(function(response){
                       alert('Incomplete Form');
                    });
                 }

        $scope.editar = function(id) {
                    $scope.conta = $scope.contas[id];
                    $scope.btnSalvar = 'edit';
                 }

        $scope.delete = function(id) {
                       $http
                            .post('/oferta/conta/destroy/'+id)
                            .success(function(data){
                              location.reload();
                            })
                            .error(function(data) {
                              alert('Unable to delete');
                           });
                }
  }]);
