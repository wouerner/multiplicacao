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
            //$('#tabelaStatus').visualize({type: 'pie',pieMargin: 75,
                                          //pieLabelPos:'inside',
                                          //height: '363px', width: '400px'});
            $('#discipulosEstado').visualize({type: 'pie',pieMargin: 30,
                                          pieLabelPos:'inside',
                                          height: '455px', width: '400px'});
            $('#discipulosRede').visualize({type: 'pie',pieMargin: 40,
                                          pieLabelPos:'inside',
                                          height: '300px', width: '400px'});
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
              <div class = "row" >
                <?php if ( $mensagem ) : ?>
                    <div class = "alert alert-success col-md-10" >
                        <strong>Mensagem:</strong> Atualizado com Sucesso
                        <a href="/discipulo/atualizar/id/<?php echo $mensagem['id']; ?>" > <?php echo $mensagem['nome'] ; ?></a>
                    </div>
                <?php endif ; ?>
                </div>

                <?php require_once 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
<!--div class="row">
    <div class="col-md-12">
            <div id="msgOracao" class="alert" style="display:none">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Sucesso!</strong> Vamos orar por você.
            </div>
            <form id="oracao" class="form-inline" action="/oracao/oracao/pedido" method="post">
            <fieldset>
                <legend>Pedido de Oração</legend>
                <input type="hidden" name="discipuloId" value="<?php echo $_SESSION['usuario_id']?>">
                    <textarea class="col-md-6" name="texto" placeholder="Seu pedido"></textarea>
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
<?php if(!empty($encontros)):?>
    <div  class="row">
        <div class="col-md-12">
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><h5 class="panel-title">Encontros</h5></div>
            <ul class="list-group">
            <?php foreach($encontros as $encontro):?>
                <li class="list-group-item">
                    <div class="btn-toolbar" role="toolbar" aria-label="...">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="#" class="btn btn-default"><?php echo $encontro->nome?></a>
                            <a class="btn btn-mini btn-primary" href="/encontroComDeus/participantesEncontro/novoParticipante/id/<?php echo $_SESSION['usuario_id'] ?>">Participar</a>
                            <a class="btn btn-mini btn-primary" href="/encontroComDeus/preEquipe/novoMembro/id/<?php echo $_SESSION['usuario_id'] ?>">Trabalhar</a>

                        </div>
                        <div class="btn-group" role="group" aria-label="...">
                            <a class="btn btn-mini btn-default" href="/encontroComDeus/participantesEncontro/lista/id/<?php echo $encontro->id?>"><i class="icon-list-alt"></i> Lista do Encontro</a>
                            <a class="btn btn-mini btn-primary" href="/encontroComDeus/equipe/listarTodasEquipes/id/<?php echo $encontro->id?>">Lista Encontreiros</a>
                            <a class="btn btn-mini btn-primary" href="/encontroComDeus/preEquipe/index/id/<?php echo $encontro->id?>">Pre-Equipe</a>
                        </div>
                    </div>
                </li>
            <?php endforeach;?>
            </ul>
        </div>
    </div>
        </div>
<?php endif;?>

<div class="row">
    <div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">Discipulos</h4>
  </div>
  <div class="panel-body">
        <?php $discipulos = array_chunk($discipulos, 12) ?>
        <?php foreach( $discipulos as $disc ) : ?>
            <div class="row">
                <?php foreach( $disc as $d ) : ?>
                    <div class="col-md-1">
                        <a  class="thumbnail" href = "/discipulo/discipulo/detalhar/id/<?php echo $d->id ; ?>" >
                           <img class="img-responsive"  src="<?php echo is_object($d->getFoto()) ? $d->getFoto()->url : '' ; ?>" alt="">
                        </a>
                        <!--div class="caption">
                           <a class = " " href = "/discipulo/discipulo/detalhar/id/<?php echo $d->id ; ?>" >
                              <i class = "<?php echo $d->eLider() ? 'icon-certificate': '' ?>"></i>
                              <i class = "<?php echo $d->eLiderCelula() ? 'icon-home': '' ?>"></i>
                              <small class = "" ><?php echo !isset($c) ? $c=1 : ++$c ; ?>-
                                  <?php echo $d->getAlcunha() ; ?>
                              </small>
                           </a>
                        </div-->
                    </div>
                <?php endforeach ; ?>
            </div>
        <?php endforeach ; ?>
    </div>
    <table class="table">

    <?php foreach ( $celulas as $c ) : ?>
        <tr>
            <td>
                <?php echo $c->nome ; ?>
            </td>
            <td>
                <a class = "btn btn-default" href="/celula/relatorio/novo/id/<?php echo $c->id ; ?>" >Novo Relatório</a>
            </td>
        </tr>

    <?php endforeach ; ?>
    </table>
    <div class="panel-footer">
                        <?php if ($acesso->hasPermission('discipulo_criar') == true): ?>
                        <a class = "btn bnt-mini btn-success" href = "/discipulo/discipulo/novoCompleto/igreja/<?php echo explode('/', $_GET['url'])[4]?>" >
                                <i class = "icon-plus icon-white" ></i>Novo Discípulo
                            </a>
                        <?php endif ; ?>
        </div>
    </div>
</div>

    </div>
</div>

<!-- div class="row">
    <div class = "col-md-4">
        <div class = "well well-small">
            <div class = "" >
                <div>
                    <b><i class="icon-gift "></i> <?php echo $totalAniver ; ?> Aniversariantes hoje:</b>
                    <?php foreach($discipulosAniver as $da) : ?>
                        <?php ++$contator ?>
                        <a href = "/discipulo/discipulo/perfil/id/<?php echo $da->id ; ?>" >
                            <?php echo $da->getAlcunha() ; ?>
                        </a>
                        <?php if ($totalAniver > $contator ) : ?>
                            -
                        <?php endif ; ?>
                    <?php endforeach ; ?>
                </div>
            </div>
        </div>
    </div>

</div-->
<?php include 'modulos/Painel/visao/coluna1.php'?>

<!-- div class = "row" >
    <div class = "col-md-12 " >
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
        </div-->

            </article>

        </section>

        </section>

        <section>
            <div id="ativosChart"></div>
            <script>
                var ativos = jQuery.get('/relatorio/grafico/ativos')
                        .done(function( data ) {
                            var chart = c3.generate({
                            bindto: '#ativosChart',
                            data: {
                              json: data,
                              type: 'pie',
                            },
                              legend: {position: 'right'}
                            });
                        });
            </script>
        </section>

    </body>
</html>
