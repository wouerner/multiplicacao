<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
    </head>
    <body>
        <section class = "container-fluid">
        <nav>
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>
                <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
        <section>
            <article>
                <div class = "row-fluid" >
                <div class = "span12" >
                    <table class="well table table-condensed">
                        <caption>
                            <h3>Lista de Governos</h3>
                        </caption>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Total Discipulos</th>
                                <th>Metas</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $governos as $governo) : ?>
                            <tr>
                                <td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
                                <td>
                                        <?php echo $governo->nome; ?> 
                                </td>
                                <?php require 'Governo/visao/tipoRede/menu.inc.php' ; ?>
                            </tr>
                        <?php endforeach ; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
