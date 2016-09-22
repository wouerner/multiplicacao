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
                <table class = "table" >
                <h3><i class="icon-screenshot"></i> Metas para: <?php echo $discipulo->nome ; ?></h3>
                <tr>
                    <th>Meta</th>
                    <th>quantidade</th>
                    <th>Inicio</th>
                    <th>Fim</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($metas as $m ) : ?>
                <tr>
                    <td><?php echo $m->nome ; ?></td>
                    <td><?php echo $m->quantidade ; ?> Discipulos</td>
                       <!-- <td><?php //echo $m->participantesTotal() ; ?></td>-->
                    <td><?php echo $m->dataInicio ; ?></td>
                    <td><?php echo $m->dataFim ; ?></td>
<td>
                    <a href = "/metas/participantesMetas/listar/id/<?php echo $m->id ?>" >
                    <i class="icon-group"></i> participantes
                    </a>

<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                    <td><a class="btn btn-danger" href = "/metas/metas/excluir/id/<?php echo $m->id ?>" >excluir</a></td>
<?php endif ; ?>
</td>
                </tr>
                <?php endforeach ; ?>
                </table>

            </article>

        </section>

        </section>
    </body>
</html>
