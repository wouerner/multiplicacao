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
            $('#tabelaStatus').visualize({type: 'pie',pieMargin: 40,
                                          pieLabelPos:'inside',
                                          height: '400px', width: '400px'});
            $('#discipulosEstado').visualize({type: 'pie',pieMargin: 40,
                                          pieLabelPos:'inside',
                                          height: '400px', width: '400px'});
            $('#discipulosRede').visualize({type: 'pie',pieMargin: 40,
                                          pieLabelPos:'inside',
                                          height: '400px', width: '400px'});
});
        </script>
    <style>
        .Visualize {
            float:left
        }
    </style>
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
<!--div class="row-fluid">
    <div class="span12">
            <div id="msgOracao" class="alert" style="display:none">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Sucesso!</strong> Vamos orar por você.
            </div>
            <form id="oracao" class="form-inline" action="/oracao/oracao/pedido" method="post">
            <fieldset>
                <legend>Pedido de Oração</legend>
                <input type="hidden" name="discipuloId" value="<?php echo $_SESSION['usuario_id']?>">
                    <textarea class="span6" name="texto" placeholder="Seu pedido"></textarea>
                    <label>
                        <input type="checkbox" name="publico"> Publico
                    </label>
                    <button class="btn" type="submit">Enviar</button>
                </fieldset>
            </form>
            <script>
                 jQuery("#oracao").submit( function(event) {
                    event.preventDefault();
                    jQuery.post( "/oracao/oracao/pedido",$("#oracao").serializeArray(), function( data ) {
                        console.log(data);
                        jQuery( "#msgOracao" ).show();
                    });
                });
            </script>
    </div>
</div-->
<div class="row-fluid">
    <div class="span12">
        <div class="well well-small">
            <ul class="unstyled">
            <?php foreach($encontros as $encontro):?>
                <li>
                    <?php echo $encontro->nome?>
                    <a class="btn btn-mini btn-primary" href="/encontroComDeus/participantesEncontro/novoParticipante/id/<?php echo $_SESSION['usuario_id'] ?>">Participar</a>
                    <a class="btn btn-mini btn-primary" href="/encontroComDeus/preEquipe/novoMembro/id/<?php echo $_SESSION['usuario_id'] ?>">Trabalhar</a>
                    <a class="btn btn-mini" href="/encontroComDeus/participantesEncontro/lista/id/<?php echo $encontro->id?>"><i class="icon-list-alt"></i> Lista do Encontro</a>
<a class="btn btn-mini btn-primary" href="/encontroComDeus/equipe/listarTodasEquipes/id/<?php echo $encontro->id?>">Lista Encontreiros</a>
                    <a class="btn btn-link" href="https://www.dropbox.com/s/4hxw9eocf3yhd8z/AUTORIZA%C3%87%C3%83O%20DOS%20PAIS%20OU%20PASTORES.docx"><i class="icon-list-alt"></i> Autorização para Pessoas de outras Igrejas</a>
                    <a class="btn btn-link" href="https://www.dropbox.com/s/timfql416k0wuv3/AUTORIZA%C3%87%C3%83O%20ENCONTRO%202014.doc?dl=0"><i class="icon-list-alt"></i> Autorização para Encotro de Crianças</a>
                </li>
            <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class = "span6">
    <div class = "well well-small">
            <!-- h5><strong> <?php// echo $totalDiscipulos ; ?>  Discipulos: </strong></h5 -->
                <?php $discipulos = array_chunk($discipulos,4) ?>
                <?php //var_dump($discipulos)?>
                <?php foreach( $discipulos as $disc ) : ?>
                <ul class="thumbnails" style="margin:0">
                    <?php foreach( $disc as $d ) : ?>
                        <li class="span1" style="margin:2px">
                           <div class="thumbnail" style="height:30px;overflow:hidden;margin:0">
                               <a  class = " " href = "/discipulo/discipulo/detalhar/id/<?php echo $d->id ; ?>" >
                                   <img  class="span12" src="<?php echo is_object($d->getFoto()) ? $d->getFoto()->url : '' ; ?>" alt="">
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
        </div>
    </div>

    <div class = "well well-small span6">
        <div class = "row-fluid" >
                <div class = "span12" >
                    <?php foreach ( $celulas as $c ) : ?>
                        <a class = "btn" href="/celula/relatorio/novo/id/<?php echo $c->id ; ?>" ><?php echo $c->nome ; ?></a>
                    <?php endforeach ; ?>
                    <?php if ($acesso->hasPermission('discipulo_criar') == true): ?>
                        <a class = "btn bnt-mini btn-success" href = "/discipulo/discipulo/novoCompleto" >
                            <i class = "icon-plus icon-white" ></i>Novo Discípulo
                        </a>
                    <?php endif ; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'modulos/painel/visao/coluna1.php'?>

<div class = "row-fluid" >
    <div class = "span12 " >
        <div class = "well well-small" >
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

            </article>

        </section>

        </section>
    </body>
</html>
