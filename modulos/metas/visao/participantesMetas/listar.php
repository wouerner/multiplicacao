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
                        <caption><h3>Participantes da Meta(<?php echo $total ; ?>)</h3></caption>

                        <?php foreach ( $participantes as $e) : ?>
                        <tr>
                            <td><?php echo $e->nome ; ?></td>
                        </tr>

                        <?php endforeach ; ?>
                        </table>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
