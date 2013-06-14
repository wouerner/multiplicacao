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

                <h3>Encontro com Deus: <?php echo $total?></h3>
                <?php require 'modulos/encontroComDeus/visao/participantesEncontro/menuParticipante.php' ; ?>

                <div class = "row-fluid" >
                        <table class = "table bordered-table">
                                        <h2></h2>
                        </caption>
                        <thead>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Pré</th>
                                <th>Encontro</th>
                                <th>Pos</th>
                                <th>desistiu?</th>
                                <th>Ações</th>
                        </thead>
                        <?php foreach ( $discipulos as $d) : ?>
                        <tr class = "<?php echo $d->desistiu==1 ? 'error' : ''; ?>" >
                            <td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
                            <td><?php echo $d->nome ; ?></td>
                            <td><i class = "<?php echo $d->preEncontro ? 'icon-ok': 'icon-remove' ; ?>" ></i></td>
                            <td><i class = "<?php echo $d->encontro ? 'icon-ok': 'icon-remove' ; ?>" ></i></td>
                            <td><i class = "<?php echo $d->posEncontro ? 'icon-ok': 'icon-remove' ; ?>" ></i></td>
                            <td><i class = "<?php echo $d->desistiu ? 'icon-ok': 'icon-remove' ; ?>" ></i></td>
                        <td>
                            <?php if ($d->preEncontro == 0 ) : ?>
                            <a class = "btn btn-mini btn-success" href = "/encontroComDeus/participantesEncontro/preEncontroAtivar/id/<?php echo $d->id ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-arrow-up" ></i>Pré</a>
                            <?php else : ?>
                            <a class = "text-error" href = "/encontroComDeus/participantesEncontro/preEncontroDesativar/id/<?php echo $d->id ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-arrow-down" ></i>Pré</a>
                            <?php endif ; ?>

                            <?php if ($d->encontro == 0 ) : ?>
                            <a class = "btn btn-mini btn-success" href = "/encontroComDeus/participantesEncontro/encontroAtivar/id/<?php echo $d->id ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-arrow-up" ></i>Encontro</a>
                            <?php else : ?>
                            <a class = "text-error"href = "/encontroComDeus/participantesEncontro/encontroDesativar/id/<?php echo $d->id ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-arrow-down" ></i>Encontro</a>
                            <?php endif ; ?>

                            <?php if ($d->posEncontro == 0 ) : ?>
                            <a class = "btn btn-mini btn-success" href = "/encontroComDeus/participantesEncontro/posEncontroAtivar/id/<?php echo $d->id ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-arrow-up" ></i>Pos</a>
                            <?php else : ?>
                            <a class = "text-error"href = "/encontroComDeus/participantesEncontro/posEncontroDesativar/id/<?php echo $d->id ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-arrow-down" ></i>Pos</a>
                            <?php endif ; ?>

                            <?php if ($d->desistiu == 0 ) : ?>
                            <a class = "btn btn-mini btn-inverse" href = "/encontroComDeus/participantesEncontro/desistiuAtivar/id/<?php echo $d->id ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-arrow-up icon-white" ></i>Desistiu</a>
                            <?php else : ?>
                            <a href = "/encontroComDeus/participantesEncontro/desistiuDesativar/id/<?php echo $d->id ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-arrow-down" ></i>Desistiu</a>
                            <?php endif ; ?>

                            <a class = "btn btn-mini btn-danger" href = "/encontroComDeus/participantesEncontro/excluir/id/<?php echo $d->id ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-remove icon-white" ></i>Excluir</a>

</td>

                        </tr>

                        <?php endforeach ; ?>
                        </table>

    </div>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
