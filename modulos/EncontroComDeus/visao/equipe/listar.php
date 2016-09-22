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
                <a class = "btn btn-success" href = "/encontroComDeus/equipe/novoEquipe/id/<?php echo $encontroId ; ?>" ><i class = "icon-plus icon-white" ></i>Nova Equipe</a>
                <a class = "btn btn-primary" href = "/encontroComDeus/equipe/listarTodasEquipes/id/<?php echo $encontroId ; ?>" ><i class = "icon-plus icon-white" ></i>Todas Equipe</a>
                <div class = "row-fluid" >
                <!--    <table class = "table bordered-table">
                    <caption><h3>Encontro: </h3></caption>-->

                <div class="accordion" id="accordionMembros">
                    <?php $c=1 ?>
                    <?php foreach ( $equipes as $e) : ?>

                <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_<?php echo ++$c ?>">
                    <strong><?php echo $e->nome ; ?>(<?php echo count($e->membros())?>)</strong><b class="caret pull-right"></b>
                    </a>
                </div>

                <div id="collapse_<?php echo $c ?>" class="accordion-body collapse">
                    <div class="accordion-inner">

                        <a href="/encontroComDeus/equipe/membros/id/<?php echo $e->id?> ">Atualizar a Equipe</a>
                        <a class = "btn btn-mini btn-danger" href="/encontroComDeus/equipe/excluirEquipe/id/<?php echo $e->id?>/encontroId/<?php echo $encontroId?> "><i class = "icon-remove icon-white" ></i>Excluir</a>

                        <table class=" table well">
                    <?php foreach ( $e->membros() as $m) : ?>
                         <tr>
                             <td><?php echo $l = !isset($l)? 1 : ++$l  ?></td>
                             <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $m->id ?>"><?php echo $m->nome ?></a></td>
                             <td>

                <form method="post" action="/encontroComDeus/equipe/novoMembro" class="form-inline">
                    <input type="hidden" value="<?php echo $m->id?>" name="discipuloId">
                    <div class="control-group">
                        <div class="controls">
                        <select class="" name="equipeId">
                            <?php foreach($equipes as $eq ):?>
                                <option value="<?php echo $eq->id?>"><?php echo $eq->nome ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn">Salvar</button>
                                <a class = "btn  btn-danger"  href="/encontroComDeus/equipe/excluirMembro/equipeId/<?php echo $e->id?>/discipuloId/<?php echo $m->id?>">Excluir</a>
                        </div>
                    </div>
                </form>

            </td>
                         </tr>
                    <?php endforeach ; ?>
                            <?php $l =0 ?>
                        </table>

                    </div>
                </div>

                </div>
                    <?php endforeach ; ?>
                </div>

            </div>
            </article>

        </section>

        </section>
    </body>
</html>
