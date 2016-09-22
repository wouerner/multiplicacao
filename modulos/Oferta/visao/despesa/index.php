<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>
        <script src="https://code.angularjs.org/1.4.6/angular-sanitize.min.js"></script>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.13.2/select.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.13.2/select.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.14.2/ui-bootstrap.min.js"></script>

        <script src="/app/controle/app.js"></script>
        <script src="/app/controle/despesas.js"></script>
	</head>
	<body ng-app="contaApp">
		<header>
			<nav>
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>
			</nav>
		</header>
		<section>
			<article>

<div ng-controller="DespesaController as ctrl" class="">
    <div class="well well-sm">
        <table class="table table-condensed">
            <caption>Despesas: <?php echo ($valor->total)?> Ofertas: <?php echo ($valorOfertas->total)?> = <?php echo $saldo?></caption>
            <thead>
                <th>#</th>
                <th>Descrição</th>
                <th>Pago?</th>
                <th>Data</th>
                <th>Valor</th>
                <th>Conta</th>
            </thead>
            <tbody>
                <tr ng-repeat="despesa in despesas">
                    <td>{{despesa.id}}</td>
                    <td>{{despesa.descricao}}</td>
                    <td>{{despesa.pago ? 'sim' :  'não' }}</td>
                    <td>{{despesa.data}}</td>
                    <td>{{despesa.valor}}</td>
                    <td>{{despesa.contaId.nome}}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" ng-click="editar($index)"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-sm btn-danger" ng-click="delete(despesa.id)">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                <tr>
            </tbody>
        </table>
    </div>
    <hr>
    <div class="well well-sm">
    <form class="form">
        <fieldset>
            <div class="form-group">
                <label class="control-label">Descricao:</label>
                <input class="form-control" type="text" name="descricao" value="{{despesa.descricao}}" ng-model="despesa.descricao">
            </div>
            <div class="form-group">
                <label>Pago?:
                    <input class="form-control" type="checkbox" ng-checked="{{despesa.pago}}" name="pago" value="{{despesa.pago}}" ng-model="despesa.pago">
                </label>
            </div>
            <div class="form-group">
                <label>Data:</label>
                <input class="form-control" type="text" name="data" value="{{despesa.data}}" ng-model="despesa.data">
            </div>
            <div class="form-group">
                <label>Valor:</label>
                <input class="form-control" type="text" name="valor" value="{{despesa.valor}}" ng-model="despesa.valor">
            </div>
            <div class="form-group">
                <label>Conta:</label>
                <ui-select ng-model="despesa.contaId"
                    theme="select2"
                    ng-disabled="disabled" style="min-width: 500px;" >
                    <ui-select-match placeholder="Conta ..."> {{$select.selected.nome}}</ui-select-match>
                    <ui-select-choices repeat="conta in contas">
                      <div ng-bind-html="conta.nome | highlight: $select.search"></div>
                    </ui-select-choices>
                </ui-select>
            </div>
            <button class="btn btn-success" ng-click="save()" ng-model="btnSalvar" value="{{btnSalvar}}">Salvar</button>
        </fieldset>
    </form>
    </div>
    </div>
</div>
			</article>
		</section>
	</body>
</html>
