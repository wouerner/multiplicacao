<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>

<script>
$(document).ready(function () {
    $(".btn-warning").click( function(){
        var id = this.id ;

    $( "#dialog-confirm" ).dialog({
        resizable: true,
        height:340,
        width: 'auto',
        modal: true,
        buttons: {
            Cancelar: function() {
                $( this ).dialog( "close" );
            },
            Desativar: function() {

                jQuery.ajax({
                    type: "POST",
                    url: '/discipulo/discipulo/desativar/id/'+id,
                    data: {observacao: jQuery("#observacao").val()},
                    success: function (){$(location).attr('href', '/discipulo/discipulo/detalhar/id/'+id); },
                });
            },
        }
        });
    });

    $(".btn-success").click( function(){
                var id = this.id ;

                $( "#dialog-success" ).dialog({
                resizable: false,
                height:240,
                modal: true,
                buttons: {
                    Cancelar: function() {
                        $( this ).dialog( "close" );
                    },
              Ativar: function() {
                        $(location).attr('href', '/discipulo/discipulo/ativar/id/'+id);
               },
                }

        });
    });

});
</script>
    </head>
<body>

    <div id="dialog-confirm" title="Deseja desativar?" style = "display:none">
        <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Quer realmente desativar?</p>
        <form id="desativarForm">
            <fieldset>
                <label for="name">Motivo:</label>
                <textarea  id="observacao" type="text" name="motivo" class="text ui-widget-content ui-corner-all form-control"></textarea>
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
        <script>
        </script>
    </div>
    <div id="dialog-success" title="Deseja ativar?" style = "display:none">
        <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Quer realmente ativar?</p>
    </div>
    <section class = "container-fluid">
        <nav>
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>
        <section>
            <article>
            <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                    Detalhar Discipulo
                </div>
              <div class="panel-body">

            <table class = "table" >
            <caption>
                <h3>
                    <span class="label">
                        <?php echo $discipulo->getGeracao()->nome?>
                    </span>
                    <?php echo $discipulo->nome ; ?>
                        <a href="/metas/metas/detalhar/id/<?php echo $discipulo->id ?>">metas</a></h3>
            </caption>
            <tr>
                <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                    <td>
                        <a id = "<?php echo $discipulo->id ?>"
                            href="/metas/metas/novo/id/<?php echo $discipulo->id ?>" class = "btn btn-mini " alt = "excluir" >
                            <i class="icon-screenshot "></i> Cadastrar Meta
                        </a>
                     </td>
                <?php endif ; ?>
                     <td>
                        <a href="/geracoes/geracao/novo/id/<?php echo $discipulo->id ?>" class = "btn btn-mini">
                        Cadastrar Geração</a>
                    </td>
                <td>
                <a id = "<?php echo $discipulo->id ?>" href="/metas/participantesMetas/novo/id/<?php echo $discipulo->id ?>" class = "btn btn-mini " alt = "" ><i class="icon-group icon-white"></i>Participantes da Meta</a>
                </td>
            </tr>

                <tr>
                    <td class = "span2" rowspan = "4">
                        <img src = "<?php $foto = $discipulo->getFoto() ; echo is_object($foto) ? $foto->url: '' ; ?>"class = "img-rounded" style="height: 150px;"  width = "150"  >
                    <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                        <a id = "" href="/discipulo/foto/novo/id/<?php echo $discipulo->id ; ?>" class = "btn btn-mini " alt = "" >
                            <i class="icon-picture "></i> Alterar Foto
                        </a>
                    <?php endif ; ?>
                    </td>


                    <td>
                    <strong>Nome:</strong>	<?php echo $discipulo->nome ; ?>
                    </td>

                    <td>
                    <strong>Líder: </strong>	<?php echo $discipulo->getLider()->nome ; ?>
                    </td>
                    <td>
                         <strong>Status Celular: </strong> <?php  echo $statusCelular['nome'] ; ?>
                    </td>
                </tr>

                <tr>
                    <td  ><strong>Endereço: </strong><?php  echo $discipulo->endereco ; ?></td>
                    <td><strong>Telefone: </strong><?php echo $discipulo->telefone ; ?></td>
                    <td><strong>E-mail: </strong><?php echo $discipulo->email ; ?></td>
                </tr>

                <tr >

                <td colspan = "3" ><strong>Participa da Célula: </strong>
                        <a href="/celula/detalhar/id/<?php echo $discipulo->celula ; ?>">
                            <?php echo $participaCelula['nomeCelula'] ; ?>
                        </a>
                    </td>
                </tr>
                <tr >
                    <td colspan = "3" ><strong>Líder da Célula: </strong>
                        <?php foreach ( $liderCelula as $celula) :?>
                        <a href="/celula/detalhar/id/<?php echo $celula['id'] ; ?>">
                            <?php echo $celula['nomeCelula'] ; ?>
                        </a> |
                        <?php endforeach ; ?>
                          </a>
                    </td>
                </tr>
                <tr>
                    <td colspan = "3" >
                <strong>Eventos:</strong>
                <?php foreach ( $eventoDiscipulo as $evento) :?>
                        <a href="/celula/detalhar/id/<?php echo $evento['id'] ; ?>">
                            <?php echo $evento['nome'] ; ?>
                        </a> |
                <?php endforeach ; ?>
                    </td>
                </tr>

                <tr  >
                    <td colspan = "3" >Ministerios:
                <?php foreach ( $ministerios as $ministerio) :?>
                            <?php echo $ministerio['funcao'] ; ?>
                            <?php echo $ministerio['ministerio'] ; ?>
                         |
                <?php endforeach ; ?>
                    </td>
                </tr>

                <tr>
                <td>
                    <table class = "table" >
                        <caption>Discipulos nas Redes</caption>
                        <?php foreach( $totalRedesLideres as $s) :?>
                        <tr>
                            <td><?php echo $s['nome']?></td>
                            <td><?php echo $s['total']?></td>
                        </tr>
                        <?php endforeach ; ?>
                    </table>
                </td>

                <td>
                    <table class = "table" >
                        <caption>Discipulos Ativos/Inativos</caption>
                        <tr>
                            <td>Discipulos ativos: <?php echo $totalAtivosLider['total'] ;  ?> </td>
                            <td>Discipulos inativos: <?php echo $totalInativosLider['total'] ;  ?> </td>
                        </tr>
                    </table>
                </td>
                </tr>

                <!-- Metas dos discipulos-->
                <?php if($metas):?>
                <tr>
                <td colspan="5">
                <table class = "table" >
                    <caption>
                        <h3>
                            <a href="/metas/metas/detalhar/id/<?php echo $discipulo->id ?>">
                                <i class="icon-screenshot"></i> Metas
                            </a>
                        </h3>
                    </caption>
                    <tr>
                        <th>Meta</th>
                        <th>quantidade</th>
                        <th>Inicio</th>
                        <th>Fim</th>
                        <th>Ações</th>
                    </tr>
                    <?php foreach ($metas as $m ): ?>
                        <tr>
                            <td><?php echo $m->nome ; ?></td>
                            <td><?php echo $m->quantidade ; ?> Discipulos</td>
                            <td><?php echo $m->dataInicio ; ?></td>
                            <td><?php echo $m->dataFim ; ?></td>
                            <td>
                                <a href = "/metas/participantesMetas/listar/id/<?php echo $m->id ?>" >
                                    <i class="icon-group"></i> Participantes
                                </a>
                                <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                    <td>
                                        <a class="btn btn-danger" href = "/metas/metas/excluir/id/<?php echo $m->id ?>" >
                                            excluir
                                        </a>
                                    </td>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                </td>
                </tr>
                <!-- Metas dos discipulos-->
                <?php endif; ?>

                <?php if($ofertas):?>
                <tr>
                <td colspan="5">
                    <table class = "table" >
                        <caption>Oferta</caption>
                        <tr>
                            <th>Jan</th>
                            <th>Fev</th>
                            <th>Mar</th>
                            <th>Abr</th>
                            <th>Maio</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Ago</th>
                            <th>Set</th>
                            <th>Out</th>
                            <th>Nov</th>
                            <th>Dez</th>
                        </tr>
                            <?php for ($i =1 ; $i <= 12 ; $i++ ): ?>
                                <td>
                                    <?php foreach ($ofertas as $oferta ): ?>
                                        <?php if($i == $oferta['mes'] ): ?>
                                            <?php foreach ($tipoOfertas as $tipo): ?>
                                                <?php echo ($tipo['nome'] == $oferta['nome']) ?
                                                            $oferta['nome'] : ''; ?>
                                            <?php endforeach; ?>
                                        <?php endif?>
                                    <?php endforeach; ?>
                                </td>
                            <?php endfor; ?>
                        </tr>
                    </table>
                </td>
                </tr>
                <?php endif; ?>


                 <tr><td><strong>Ações</strong></td></tr>
                </table>


              </div>
                <div class="panel-footer">
                    <?php require 'Discipulo/visao/menuDiscipulo.inc.php' ; ?>
                </div>
            </div>



            </div>
            </article>
        </section>
        </section>
        <section>
            <?php $cont=0 ?>
            <?php foreach ($statusCelulares as $status ): ?>
                <div class="span3">
                    <table class="table table-condensed">
                    <legend><?php echo $status->nome?></legend>
                    <tbody>
                    <?php $cont=0 ?>
                    <?php foreach ($discipulos as $discipulo ): ?>
                        <?php if($status->id == $discipulo->getStatusCelular()['id'] && $discipulo->ativo):?>
                            <tr>
                                <td><?php echo ++$cont ?></td>
                                <td><?php echo $discipulo->getAlcunha() ; ?></td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                    </tbody>
                    </table>
                </div>
            <?php endforeach ?>
            <?php $cont=0 ?>
            <?php foreach ($statusCelulares as $status ): ?>
                <div class="span3">
                    <table class="table table-condensed">
                    <legend><?php echo $status->nome?></legend>
                    <tbody>
                    <?php $cont=0 ?>
                    <?php foreach ($discipulos as $discipulo ): ?>
                        <?php if($status->id == $discipulo->getStatusCelular()['id'] && $discipulo->ativo):?>
                            <tr>
                                <td><?php ++$cont ?></td>
                                <td><?php echo $discipulo->getAlcunha() ; ?></td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                    </tbody>
                    </table>
                </div>
            <?php endforeach ?>
        </section>
    </body>
</html>
