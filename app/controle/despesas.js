/**
 * @ngdoc function
 * @name yoExemploApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the yoExemploApp
 */
app.controller('DespesaController', ['$scope', '$http', function ($scope, $http){
        $scope.despesa = {};
        $scope.despesas = [];
        $scope.btnSalvar = 'save';
        $scope.contas = [];

        $scope.getDespesas = function(){
            $http.get('/oferta/despesa/all').
                success(function(data, status, headers, config) {
                    $scope.despesas = data;
                });
        }

        $scope.getDespesas();
        console.log($scope.despesas);

        $scope.getContas = function(search){
            $http.get('/oferta/conta/all').
                success(function(data, status, headers, config) {
                    $scope.contas = data;
                });
        }

        $scope.getContas('');

        $scope.save = function() {
                    $scope.despesa.contaId = $scope.despesa.contaId.id;
                    $http({
                       method  : 'POST',
                       url     : $scope.btnSalvar == 'save' ? '/oferta/despesa/store' : '/oferta/despesa/update/'+ $scope.despesa.id,
                       data    : jQuery.param($scope.despesa) ,  // pass in data as strings
                       headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
                    }).
                    success(function(response){
                        $scope.despesas = {};
                        location.reload();
                    }).
                    error(function(response){
                       alert('Incomplete Form');
                    });
                 }

        $scope.editar = function(id) {
            $scope.despesa = $scope.despesas[id];
            angular
                .forEach($scope.contas,
                            function(value, key)
                            {
                                console.log(value);
                                if (value.id == $scope.despesa.id){
                                    $scope.despesa.contaId = {id: $scope.despesa.id , nome: value.nome};
                                }
                            });

                    $scope.btnSalvar = 'edit';
                 }

        $scope.delete = function(id) {
                       $http
                            .post('/oferta/despesa/destroy/'+id)
                            .success(function(data){
                              location.reload();
                            })
                            .error(function(data) {
                              alert('Unable to delete');
                           });
                }
  }]);
