<?php
                $mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
                $_SESSION['mensagem']=  isset($_SESSION['mensagem']) ? NULL : NULL;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>

        <script src="../modulos/discipulo/visao/js/novo.js"></script>
        <script src = "/modulos/discipulo/visao/js/pesquisa.js" ></script>
        <script>
            $(document).ready(function() {
            $("table").tablesorter();
            }
                );
        </script>

        <style type="text/css">
           @import url("../../../ext/jQuery-Visualize/css/visualize.css");
        </style>
        <script src="../../../ext/jQuery-Visualize/js/visualize.jQuery.js"></script>
        <script>
$(function(){
            $('#tabelaStatus').visualize({type: 'pie',pieMargin: 60,
                                          pieLabelPos:'outside',
                                          height: '300px', width: '500px'});
            $('#discipulosEstado').visualize({type: 'pie',pieMargin: 60,
                                          pieLabelPos:'outside',
                                          height: '300px', width: '500px'});
            $('#discipulosRede').visualize({type: 'pie',pieMargin: 60,
                                          pieLabelPos:'outside',
                                          height: '400px', width: '500px'});
});
        </script>
    </head>
    <body>
        <section class = "container-fluid">
        <nav>
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>
        <section>
            <article>
              <div class = "row-fluid" >
                <?php if ( $mensagem ) : ?>
                    <div class = "alert alert-success span10" >
                        <strong>Mensagem:</strong> Atualizado com Sucesso
                        <a href="/discipulo/atualizar/id/<?php echo $mensagem['id']; ?>" > <?php echo $mensagem['nome'] ; ?></a>
                    </div>
                <?php endif ; ?>
                </div>

                <?php require_once 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
<div class="row-fluid">
    <div class="span12">
    <div class="alert">
        <a id = "<?php //echo $discipulo->id ?>" href="/encontroComDeus/preEquipe/novoMembro/id/<?php echo $_SESSION['usuario_id'] ?>" class = "" alt = "" > <i class="icon-wrench"></i>Me candidatar a Trabalhar no Encontro</a>
        <a href="http://m.mga12.org/encontroComDeus/participantesEncontro/lista/id/9">  <i class="icon-list-alt"></i> Lista do Encontro</a>
    </div>
    </div>
</div>

<div class = "row-fluid" >
    <div class = "span6" >
        <div class = "well" >
        <h4><i class="icon-gift "></i> <?php echo $totalAniver ; ?> Aniversariantes hoje:</h4>
                        <?php foreach($discipulosAniver as $da) : ?>
                            <?php ++$contator ?>
                            <a href = "/discipulo/discipulo/perfil/id/<?php echo $da->id ; ?>" >
                            <?php if ( isset($da->alcunha) || $da->alcunha!=''): ?>
                            <?php echo $da->alcunha ; ?>
                            <?php else : ?>
                            <?php echo $da->nome ; ?>

                            <?php endif ; ?>
                            </a>

                            <?php if ($totalAniver > $contator ) : ?>
                                -
                            <?php endif ; ?>
                        <?php endforeach ; ?>

        </div>
<div class="accordion" id="avisosCollapse">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#avisos" href="#avisos"><i class="icon-bullhorn"></i> Avisos <b class="caret pull-right"></b></a>
        </div>
        <div id="avisos" class="accordion-body collapse">
        <div class="accordion-inner">

                <?php require 'modulos/aviso/visao/tabAviso.inc.php' ; ?>
</div>
</div>
</div>
</div>

<div class = "well" >

<div class="accordion" id="accordion2">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Status da Igreja <b class="caret pull-right"></b></a>
        </div>
        <div id="collapseOne" class="accordion-body collapse">
        <div class="accordion-inner">
                    <table id="tabelaStatus" class = "table table-striped  tablesorter " >
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">Quantidade</th>
                            <th>%</th>
                        </tr>
                    </thead>
                        <tbody>
                        <?php foreach($status as $s) : ?>
                            <tr>
                                <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                    <th scope="row"><a href="/statusCelular/statusCelular/listarDiscipulosPorStatus/id/<?php echo $s['tipoStatusCelular'] ; ?>" ><?php echo $s['tipoNome'] ; ?></a></th>
                                <?php else :?>
                                    <td><?php echo $s['tipoNome'] ; ?></td>
                                <?php endif ; ?>
                                    <td><?php echo $s['total'] ; ?></td>
                                 <!--   <td><?php echo round($s['porcentagem'],1).'%' ; ?></td>-->
                            </tr>
                        <?php endforeach ; ?>
                            <!-- <tr  class = "info" ><td>Total</td><td colspan = "2">
                                <?php echo $totalDiscipulos ; ?>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
        </div>
    </div>
</div>

    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Discipulos por Rede<b class="caret pull-right"></b></a>
        </div>

        <div id="collapseTwo" class="accordion-body collapse">
        <div class="accordion-inner">
                <table class = "table " >
                    <caption><h5>Total Redes</h5></caption>
                    <thead>
                        <th>Nome</th>
                        <th>Discipulos</th>
                        <th>Celulas</th>
                        <th>Metas</th>
                    </thead>
                    <tbody>
                        <?php $total['discipulos']=0?>
                        <?php $total['celulas']= 0?>
                        <?php $total['metas']= 0?>
                        <?php foreach( $tiposRedes as $s) :?>
                        <tr>
                            <td>
                                <a href = "/rede/rede/listarMembrosRede/id/<?php echo $s->id ; ?>"><?php echo $s->nome ?></a>
                            </td>
                            <td>
                            <a href = "/rede/rede/listarMembrosRede/id/<?php echo $s->id ; ?>"><?php echo $s->totalDiscipulosPorRede() ?></a>
                            </td>
                            <td>
                                <a href = "/rede/rede/listarCelulas/id/<?php echo $s->id ; ?>"><?php echo $s->listarCelulasTotal() ?></a>
                            </td>
                            <td>
                                <a href = "#"><?php echo $s->getMeta() ?></a>
                            </td>
                        </tr>
                        <?php $total['discipulos'] += $s->totalDiscipulosPorRede()?>
                        <?php $total['celulas']+= $s->listarCelulasTotal()?>
                        <?php $total['metas']+= $s->getMeta()?>
                        <?php endforeach ; ?>

                        <tr class = "info" >
                            <td></td>
                            <td><?php echo $total['discipulos'] ; ?></td>
                            <td><?php echo $total['celulas'] ; ?></td>
                            <td><?php echo $total['metas'] ; ?></td>
                        </tr>
                    </tbody>
                </table>
                <table style="display:none" id="discipulosRede" class = "table " >
                    <thead>
                        <tr>
                            <td></td>
                            <th socpe="col">quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total['discipulos']=0?>
                        <?php $total['celulas']= 0?>
                        <?php $total['metas']= 0?>
                        <?php foreach( $tiposRedes as $s) :?>
                        <tr>
                            <th scope="row">
                                 <?php echo $s->nome ?>
                            </th>
                            <td>
                                <?php echo $s->totalDiscipulosPorRede() ?></a>
                            </td>
                        </tr>
                        <?php $total['discipulos'] += $s->totalDiscipulosPorRede()?>
                        <?php $total['celulas']+= $s->listarCelulasTotal()?>
                        <?php $total['metas']+= $s->getMeta()?>
                        <?php endforeach ; ?>
                    </tbody>
                </table>
        </div>
        </div>
    </div>

    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTree">
                Discipulos Ativos/Inativos/Arquivados<b class="caret pull-right"></b>
            </a>
        </div>
        <div id="collapseTree" class="accordion-body collapse">
            <div class="accordion-inner">
                <table class = "table " >
                    <thead>
                        <th scope="col">Ativos</th>
                        <th scope="col">Inativos</th>
                        <th scope="col">Arquivados</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"><?php echo $totalAtivos['total'] ; ?></td>
                            <td scope="row"><?php echo $totalInativos['total'] ; ?></td>
                            <td scope="row"><?php echo $totalArquivados['total'] ; ?></td>
                        </tr>
                    </tbody>
                </table>

                <table style="display:none" id="discipulosEstado" class = "table " >
                    <thead>
                        <tr>
                            <td></td>
                            <th socpe="col">quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Ativos</th>
                            <td><?php echo $totalAtivos['total'] ; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Inativos</th>
                            <td><?php echo $totalInativos['total'] ; ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Arquivados</th>
                            <td><?php echo $totalArquivados['total'] ; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse4">
                Gerações<b class="caret pull-right"></b>
            </a>
        </div>
        <div id="collapse4" class="accordion-body collapse">
            <div class="accordion-inner">
                <table class = "table " >
                    <thead>
                        <th>Nome</th>
                        <th>Quantidade</th>
                    </thead>
                    <tbody>
                            <?php foreach($geracoes as $g):?>
                        <tr>
                            <td><?php echo $g->nome ; ?></td>
                            <td><?php echo $g->quantidade() ; ?></td>
                        </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>

</div>

<div class = "span6 " >
<div class = "row-fluid" >
                <div class = "span12 well well-small">
                <div class = "row-fluid" >
                <h5><strong> <?php echo $totalDiscipulos ; ?>  Discipulos: </strong></h5>
                <?php $discipulos = array_chunk($discipulos,4) ?>
                <?php //var_dump($discipulos)?>
                <?php foreach( $discipulos as $disc ) : ?>
                <ul class="thumbnails">
                <?php foreach( $disc as $d ) : ?>
          <li class="span3">
               <div class="thumbnail">
                   <a class = " " href = "/discipulo/discipulo/detalhar/id/<?php echo $d->id ; ?>" >
                       <img  src="<?php echo is_object($d->getFoto()) ? $d->getFoto()->url : '' ; ?>" alt="">
                   </a>
               <div class = "caption" >
                     <a class = " " href = "/discipulo/discipulo/detalhar/id/<?php echo $d->id ; ?>" >
              <i class = "<?php echo $d->eLider() ? 'icon-certificate': '' ?>"></i>
              <i class = "<?php echo $d->eLiderCelula() ? 'icon-home': '' ?>"></i>
                          <small class = "" ><?php echo !isset($c) ? $c=1 : ++$c ; ?>-
                 <?php echo $d->getAlcunha() ; ?>
              </small>
            </a>
           </div>
        </div>
       </li>
                <?php endforeach ; ?>
     </ul>
                <?php endforeach ; ?>

                <?php if ($acesso->hasPermission('discipulo_criar') == true): ?>
                            <div class = "span3 " >
                          <a class = "span12 btn bnt-mini btn-success" href = "/discipulo/discipulo/novoCompleto" >
                                    <i class = "icon-plus icon-white" ></i>Novo Discípulo
                            </a>
                            </div>
                    <?php endif ; ?>
                </div>
                </div>
</div>

<div class = "row-fluid" >
                    <div class = "span12" >
                    <div class = "well" >
                    <strong>Relatório de Célula:</strong>
                <?php foreach ( $celulas as $c ) : ?>
                        <a class = "btn" href="/celula/relatorio/novo/id/<?php echo $c->id ; ?>" > <?php echo $c->nome ; ?></a>
                    <?php endforeach ; ?>
                </div>
                </div>
    </div>

<div class = "row-fluid" >
<div class = "span12" >

</div>

<div class = "row-fluid" >
<div class = "span12 " >
<div class = "well" >
<div class="accordion" id="accordion3">

    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse4">Meus Discipulos por Status<b class="caret pull-right"></b></a>
        </div>

        <div id="collapse4" class="accordion-body collapse ">
            <div class="accordion-inner">

            <table class = "table " >
                <thead>
                    <th>Status</th>
                    <th>Quantidade</th>
            </thead>
            <tbody>
                <?php foreach( $statusDiscipulos as $s) :?>
                    <tr>
                        <td><?php echo $s['tipoNome']?></td>
                        <td><?php echo $s['total']?></td>
                    </tr>
                <?php endforeach ; ?>
                    <tr class = "info" >
                                <td>Total</td>
                                <td><?php echo $statusDiscipulosTotal ; ?></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse5">Meus Discipulos por Rede<b class="caret pull-right"></b></a>
        </div>

        <div id="collapse5" class="accordion-body collapse">
            <div class="accordion-inner">
                <table class = "table " >
                    <thead>
                        <th>Status</th>
                        <th>Quantidade</th>
                    </thead>
                    <tbody>
                        <?php foreach( $totalRedesLideres as $s) :?>
                        <tr>
                            <td><?php echo $s['nome']?></td>
                            <td><?php echo $s['total']?></td>
                        </tr>
                        <?php endforeach ; ?>
                        <tr class = "info" >
                            <td>Total</td>
                            <td><?php echo $somaRedeDiscipulos ; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse6">Meus Discipulos Ativos/Inativos<b class="caret pull-right"></b></a>
        </div>

        <div id="collapse6" class="accordion-body collapse">
            <div class="accordion-inner">
                <table class = "table " >
                    <thead>
                        <th>Ativos</th>
                        <th>Inativos</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $totalAtivosLider['total'] ; ?></td>
                            <td><?php echo $totalInativosLider['total'] ; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>

            </article>

        </section>

        </section>
    </body>
</html>
