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

        <section>
            <article>

                <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>

                <div class = "row" >
                    <div class = "span12" >
                            <table class = "table bordered-table">
                                <caption><h3>Tipos de Gerações</h3></caption>
                                <?php foreach ($tipos as $t): ?>
                                    <tr>
                                        <td>
                                            <?php echo $t->nome?>
                                         </td>
                                        <td>
                                            <a href="/geracoes/tipoGeracao/atualizar/id/<?php echo $t->id?>" >Atualizar</a>
                                         </td>
                                    </tr>
                                <?php endforeach ?>
                            </table>
                        <div class = "form-actions" >
                    </div>
                </div>
            </div>
            </article>
        </section>
        </section>
    </body>
</html>
