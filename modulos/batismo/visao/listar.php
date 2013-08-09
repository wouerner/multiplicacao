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
                      <caption><h3>Discipulos Batizados</h3></caption>
                                <thead>
                         <th>#</th>
                         <th>Nome</th>
                      </thead>
                    <form action="/batismo/batismo/diploma" method="post">
                    <?php foreach ($discipulos as $m ) : ?>
                            <tr>
                <td><input type="checkbox" name="ids[]" value="<?php echo $m->id ; ?>"></td>
                <td><?php echo $m->nome ; ?></td>
              </tr>
                    <?php endforeach ; ?>
                    <button class="btn" type="submit">Gerar Diploma</button>
                    </form>
          </table>
                <div>
            </article>

        </section>

        </section>
    </body>
</html>
