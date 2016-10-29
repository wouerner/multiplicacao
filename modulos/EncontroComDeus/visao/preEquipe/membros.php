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

                <div class = "row-fluid" >
                        <table class = "table bordered-table">
                        <caption><h3>Membros</h3></caption>

                        <?php foreach ( $membros as $e) : ?>
                        <tr>
                            <td><?php echo  !isset($c) ? $c=1 : ++$c ; ?></td>
                            <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $e->id ; ?>"><?php echo  $e->nome ?></a></td>
                            <td><a class = "btn btn-mini btn-danger"  href="/encontroComDeus/equipe/excluirMembro/equipeId/<?php echo $equipe->id?>/discipuloId/<?php echo $e->id?>">
                                        <i class = "icon-remove - icon-white" ></i>Excluir</a></td>
                        </tr>

                        <?php endforeach ; ?>
                        </table>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
