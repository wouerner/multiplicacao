<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>

    <body>
        <section class = "container-fluid">

        <nav>

            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>

        <section>
            <article>

                <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
                <a class = "btn btn-success" href = "/encontroComDeus/equipe/novoEquipe/id/<?php //echo $encontroId ; ?>" ><i class = "icon-plus icon-white" ></i>Nova Equipe</a>
                <div class = "row-fluid" >
                        <table class = "table bordered-table">
                        <caption><h3>Equipe Completa</h3></caption>
                        <?php foreach ( $eq as $k => $v ) : ?>
                        <tr>
                            <td><h4><?php echo $k ; ?></h4></td>
                        </tr>
                        <?php foreach ( $v as $e) : ?>
                        <tr>
                            <td><?php echo $e['dNome'] ; ?></td>
                        </tr>
                        <?php endforeach ; ?>
                        <?php endforeach ; ?>
                        </table>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
