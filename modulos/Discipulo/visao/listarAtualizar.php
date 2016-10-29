<?php
                $mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
                $_SESSION['mensagem']=  isset($_SESSION['mensagem']) ? NULL : NULL;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>

        <script src="../modulos/Discipulo/visao/js/novo.js"></script>
        <script src = "/modulos/Discipulo/visao/js/pesquisa.js" ></script>

<script type="text/javascript">
   $(document).ready(function() {

        $(function() {

                  $( ".dataNascimento" ).datepicker();
    });

jQuery(function($) {
  $('.editar').each(function() {

    $.data(this, 'dialog',
      $(this).next('.editar + div.oculto').dialog({
        autoOpen: false,
        modal: true,
        width: 960,
        draggable: false ,
                buttons : {
                            Excluir: function(){
                            var id = $(this).find("#idDiscipulo").val() ;
                        $(function() {
                $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:240,
            modal: true,
            buttons: {
                Excluir: function() {
                                        $(location).attr('href', '/discipulo/discipulo/excluir/id/'+id);
                },
                Cancelar: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });
                    } }

      })
    );
//teste

//

  }).click(function() {
      $.data(this, 'dialog').dialog('open');

      return false;
  });
    });

    });
</script>

<script>
   $(document).ready(function() {

              $( ".piscar" )
                             .effect('shake',{times : 1, distance : 10},500);

        });
        </script>

<script>
//	$(function() {
        // a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
        //$( "#dialog:ui-dialog" ).dialog( "destroy" );

/*		$( ".dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "Delete all items": function() {
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    });*/

/*		$( ".dialog-confirm" ).click(function () {
        $( ".dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "Delete all items": function() {
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        });*/
    </script>

        <script src="/modulos/Discipulo/visao/js/combobox.js"></script>
        <script src="/modulos/Discipulo/visao/js/comboboxCelula.js"></script>
    </head>

    <body>

<div id="dialog-confirm" title="Empty the recycle bin?" style = "display:none">
    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Quer realmente excluir?</p>
</div>

        <section class = "container-fluid">

        <nav>

            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>
        <section class = "" >
            <article>

                <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>

                <?php if ( $mensagem ) : ?>
              <div class = "row-fluid" >
                    <div class = "span12" >
                    <div class = "alert alert-<?php //echo $mensagem[000]['classe'] ; ?>" >
                    <strong>Mensagem:</strong> <?php //echo $mensagem[000]['mensagem'] ; ?>
                        <?php if (isset($mensagem['discipulo'])) : ?>
                                <a href = "/discipulo/atualizar/id/<?php echo $mensagem['discipulo']['id']?>" ><?php echo $mensagem['discipulo']['nome']?></a>
                        <?php endif ; ?>
                </div>
                </div>
                </div>
                <?php endif ; ?>

              <div class = "row-fluid" >
                        <h3 class = "" > Total de discípulos: <?php echo $totalDiscipulos?></h3>
                </div>

                        <?php foreach ( $discipulos as $discipulo ) : ?>
                            <?php $lider = $discipulo->getLider() ; ?>
                            <?php $status = $discipulo->getStatusCelular() ; ?>
                            <?php $dataN = $discipulo->getDataNascimento()->format('d/m/Y') ; ?>

                            <div class = "row-fluid " >
                                <h3 class = " piscar" ><a href = "/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ; ?>" ><?php echo $discipulo->nome ; ?></a> <?php echo $discipulo->alcunha ? '( '.$discipulo->alcunha.' )' : ''; ?> </h3>
                                    <a href = "/statusCelular/novo/id/<?php echo $discipulo->id?>" ><span class = "badge "  >Status:<?php echo $status['nome']; ?></span></a>
                                        <h5 class = "" >
                                            <a href= "/discipulo/discipulo/detalhar/id/<?php echo is_object($lider) ? $lider->id : '';?>">
                                                Líder:<?php echo is_object($lider) ? $lider->nome : ''; ?></h5>
                                    </a>

                                        <p class = "span5" >Endereço: <?php echo $discipulo->endereco; ?></p>
                                        <p class = "span4" >Telefone: <?php echo $discipulo->telefone; ?></p>
                                        <p class = "span2" >Data Nasc.: <?php echo $dataN ; ?></p>

                                    <button class = "btn btn-mini span1 editar" ><i class = "icon-pencil" ></i></button>
                                    <div class = "oculto ui-widget" >
                                      <?php include 'Discipulo/visao/formularioAtualizar.inc.php' ; ?>
                            </div>
            </div>
            </div>
                <?php endforeach ; ?>
                    <div class = "span12" >
                        <?php  discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos ,
                                                                                              $quantidadePorPagina ,
                                                                                            $pagina ) ; ?>
                    </div>
            </article>

        </section>

        </section>
    </body>
</html>
