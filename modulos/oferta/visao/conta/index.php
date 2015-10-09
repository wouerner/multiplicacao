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

        <script src="/app/controle/app.js"></script>
        <script src="/app/controle/conta.js"></script>
	</head>
	<body ng-app="contaApp">
		<header>
			<nav>
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>
			</nav>
		</header>
		<section>
			<article>

<div ng-controller="ContaController as ctrl" class="">
    <div class="well well-sm">
        <table class="table table-condensed">
            <thead>
                <th>#</th>
                <th>Titulo</th>
            </thead>
            <tbody>
                <tr ng-repeat="conta in contas">
                    <td>{{conta.id}}</td>
                    <td>{{conta.nome}}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" ng-click="editar($index)"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-sm btn-danger" ng-click="delete(conta.id)">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </td>
                <tr>
            </tbody>
        </table>
    <hr>
    <form class="form-inline">
        <fieldset>
            <div class="form-group">
                <label>Titulo:</label>
                <input class="form-control" type="text" name="nome" value="{{conta.nome}}" ng-model="conta.nome">
            </div>
            <button class="btn btn-success" ng-click="save()" ng-model="btnSalvar" value="{{btnSalvar}}">Salvar</button>
        </fieldset>
    </form>
    </div>
</div>
			</article>
		</section>
	</body>
</html>
