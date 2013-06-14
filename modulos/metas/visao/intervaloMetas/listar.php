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
                        <caption><h3>Intevalos das metas</h3></caption>
                        <thead>
                            <th>Nome</th>
                            <th>Data do Inicio</th>
                            <th>Data de Fim</th>
                        </thead>

                        <?php foreach ( $intervalos as $t) : ?>

                        <tr>
                            <td><?php echo $t->nome ; ?></td>
                            <td><?php echo $t->dataInicio ; ?></td>
                            <td><?php echo $t->dataFim ; ?></td>
                        </tr>

                        <?php endforeach ; ?>
                        </table>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
