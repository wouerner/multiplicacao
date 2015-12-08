<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL;
$_SESSION['mensagem'] = isset($_SESSION['mensagem']) ? NULL : NULL;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>

        <script src="https://code.angularjs.org/1.4.6/angular-sanitize.min.js"></script>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.5/select2.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.13.2/select.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.13.2/select.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.14.2/ui-bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/ng-table/1.0.0-beta.8/ng-table.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ng-table/1.0.0-beta.8/ng-table.min.css">

        <script src="/app/controle/app.js"></script>
        <script src="/app/controle/discipuloListar.js"></script>
    </head>
	<body ng-app="contaApp">
        <section class = "container-fluid">
            <nav>
                <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
            <section ng-controller="DiscipuloListarController" >
                <article>
                     <table ng-table="tableParams" class="table" show-filter="true">
                        <tr ng-repeat="user in $data">
                            <td title="'Id'" filter="{ id: 'number'}" sortable="'id'">
                                {{user.id}}
                            </td>
                            <td title="'Nome'" filter="{ nome: 'text'}" sortable="'nome'">
                                {{user.nome}}
                            </td>
                            <td title="'Ações'">
                                <a href="/discipulo/discipulo/atualizar/id/{{user.id}}" class = "btn btn-mini btn-primary " >
                                    <i class="icon-edit icon-white"></i> Atualizar
                                </a>
                            </td>
                        </tr>
                    </table>
                </article>
            </section>
        </section>
    </body>
</html>
