<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php //include 'incluidos/js.inc.php' ?>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>

        <script src="https://code.angularjs.org/1.4.6/angular-sanitize.min.js"></script>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.13.2/select.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.13.2/select.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.14.2/ui-bootstrap.min.js"></script>

        <script src="/app/controle/igreja.js"></script>
	</head>
	<body ng-app="IgrejaApp">
		<header>
			<nav>
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>
			</nav>
		</header>
		<section>
			<article>
                <div ng-controller="IgrejaController as ctrl" class="">
                    <div class="well well-sm">
                        <table class="table table-condensed">
                            <thead>
                                <th>#</th>
                                <th>Nome</th>
                            </thead>
                            <tbody>
                                <tr ng-repeat="igreja in igrejas">
                                    <td>{{igreja.id}}</td>
                                    <td>{{igreja.nome}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" ng-click="editar($index)"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger" ng-click="delete(igreja.id)">
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
                                <label>Nome:</label>
                                <input class="form-control" type="text" name="nome" value="{{igreja.nome}}" ng-model="igreja.nome">
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
