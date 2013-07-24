<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>

<script>
$(function () {
$('.table').tab('show');
})
</script>

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
                    <table class = "table" >
          <caption><h3>Discipulos com Meta</h3></caption>
                    <thead>
             <th>Nome</th>
             <th>Quantidade</th>
             <th>Ações</th>
          </thead>

                    <?php foreach ($metas as $m ) : ?>
                            <tr>
                <td><?php echo $m->nome ; ?></td>
                <td><?php echo $m->quantidade ; ?></td>
                <td><a class = "btn btn-danger btn-mini" href = "/metas/metas/excluir/id/<?php echo $m->metaId?>" >Excluir</a></td>
              </tr>
                    <?php endforeach ; ?>
          </table>
                <div>
            </article>

        </section>

        </section>
    </body>
</html>
