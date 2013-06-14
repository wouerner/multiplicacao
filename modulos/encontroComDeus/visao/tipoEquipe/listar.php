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

                <?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>

                <div class = "row-fluid" >
                        <table class = "table bordered-table">
                        <caption><h3>Tipo de Equipe</h3></caption>

                        <?php foreach ( $tipoEquipes as $t) : ?>

                        <tr>
                            <td><?php echo $t->nome ; ?></td>
                            <td><a class = "btn btn-mini btn-danger" href="/encontroComDeus/tipoEquipe/excluir/id/<?php echo $t->id ; ?>"> <i class = "icon-remove icon-white" ></i>Excluir</a></td>
                        </tr>

                        <?php endforeach ; ?>
                        </table>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
