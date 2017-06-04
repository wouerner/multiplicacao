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
                <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
                <h3>Quantidade de Encontrista: <?php echo $total?></h3>
                <?php require 'modulos/EncontroComDeus/visao/participantesEncontro/menuParticipante.php' ; ?>
                <div class = "row-fluid" >
                    <div class="panel panel-default">
                      <div class="panel-heading">Todos os particpantes</div>
                      <div class="panel-body">
                        <table class = "table bordered-table">
                        <thead>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Líder</th>
                                <th>Pré?</th>
                                <th>Encontro?</th>
                                <th>Pos?</th>
                                <th>Igreja Local?</th>
                                <th>desistiu?</th>
                                <th>Ações</th>
                        </thead>
                        <?php foreach ( $discipulos as $d) : ?>
                        <tr class = "<?php echo $d->desistiu==1 ? 'error' : ''; ?>" >
                            <td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
                            <td><a target="blank" href="/discipulo/discipulo/atualizar/id/<?php echo $d->id?>"><?php echo $d->nome ; ?></a></td>
                            <td><a target="blank" href="/discipulo/discipulo/atualizar/id/<?php echo $d->getLider()->id ?>"><?php echo $d->getLider()->getAlcunha() ; ?></a></td>
                        <td>
                            <?php if ($d->preEncontro == 0 ) : ?>
                            <a class = "btn btn-mini " href = "/encontroComDeus/participantesEncontro/preEncontroAtivar/id/<?php echo $d->participanteId ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>">
                            <i class = "icon-remove" ></i>
                            </a>
                            <?php else : ?>
                            <a class = "text-error" href = "/encontroComDeus/participantesEncontro/preEncontroDesativar/id/<?php echo $d->participanteId ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>">
                                <i class = "icon-ok" ></i></a>
                            <?php endif ; ?>
</td><td>
                            <?php if ($d->encontro == 0 ) : ?>
                            <a class = "btn btn-mini " href = "/encontroComDeus/participantesEncontro/encontroAtivar/id/<?php echo $d->participanteId ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-remove" ></i></a>
                            <?php else : ?>
                            <a class = "text-error"href = "/encontroComDeus/participantesEncontro/encontroDesativar/id/<?php echo $d->participanteId; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-ok" ></i></a>
                            <?php endif ; ?>

</td><td>
                            <?php if ($d->posEncontro == 0 ) : ?>
                            <a class = "btn btn-mini " href = "/encontroComDeus/participantesEncontro/posEncontroAtivar/id/<?php echo $d->participanteId ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-remove" ></i></a>
                            <?php else : ?>
                            <a class = "text-error"href = "/encontroComDeus/participantesEncontro/posEncontroDesativar/id/<?php echo $d->participanteId ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-ok" ></i></a>
                            <?php endif ; ?>

</td><td>
                            <?php if ($d->igrejaLocal == 0 ) : ?>
                            <a class = "btn btn-mini btn-inverse" href = "/encontroComDeus/participantesEncontro/igrejaAtivar/id/<?php echo $d->participanteId ; ?>"><i class = "icon-remove icon-white" ></i></a>
                            <?php else : ?>
                            <a href = "/encontroComDeus/participantesEncontro/igrejaDesativar/id/<?php echo $d->participanteId ; ?>"><i class = "icon-ok" ></i></a>
                            <?php endif ; ?>

</td><td>
                            <?php if ($d->desistiu == 0 ) : ?>
                            <a class = "btn btn-mini btn-inverse" href = "/encontroComDeus/participantesEncontro/desistiuAtivar/id/<?php echo $d->participanteId ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-remove" ></i>Desistiu</a>
                            <?php else : ?>
                            <a href = "/encontroComDeus/participantesEncontro/desistiuDesativar/id/<?php echo $d->participanteId ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-ok" ></i></a>
                            <?php endif ; ?>
</td>
<td>
                            <a class = "btn btn-mini btn-danger" href = "/encontroComDeus/participantesEncontro/excluir/id/<?php echo $d->participanteId ; ?>/encontroId/<?php echo $participante->encontroComDeusId?>"><i class = "icon-remove icon-white" ></i>Excluir</a>

</td>

                        </tr>

                        <?php endforeach ; ?>
                        </table>




                      </div>
                    </div>


    </div>
            </div>
            </article>
        </section>
        </section>

<style type="text/css">
    @import url("http://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css");
</style>
<script src="http://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script>
    console.log(jQuery);
    $(document).ready(function(){
        $('table').DataTable({
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
                },
                "iDisplayLength": 100
            }
        );
    });
</script>

    </body>
</html>
