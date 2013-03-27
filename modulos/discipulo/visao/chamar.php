<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ?>
		<?php include 'incluidos/js.inc.php' ?>
		<script src = "/modulos/discipulo/visao/js/pesquisa.js" ></script>
		<script src="/modulos/discipulo/visao/js/combobox.js"></script>
		<script src="/modulos/discipulo/visao/js/comboboxCelula.js"></script>
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
										$(location).attr('href', '/discipulo/excluir/id/'+id);
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

	</head>

	<body>
<div id="dialog-confirm" title="Empty the recycle bin?" style = "display:none">
    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Quer realmente excluir?</p>
</div>
		<section class = "container-fluid">

		<nav> 
			<?php require 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
			

		<section>		
			<article>

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
			<div class = "row" >	
						<?php if (is_null($nome) ) : ?>
							<div class = "span12" >
							<h3>Faça sua pesquisa!</h3>
							</div>
						<?php else : ?>

				<?php foreach ( $discipulos as $discipulo ) : ?>
						<?php $lider = $discipulo->getLider() ; ?>
						<?php $status = $discipulo->getStatusCelular() ; ?>
						<?php $dataN = $discipulo->getDataNascimento()->format('d/m/Y') ; ?>

						  <div class = "span12 borda" >

								<h3 class = "span8" ><a href = "/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ; ?>" ><?php echo $discipulo->nome ; ?></a></h3>
									<a href = "/statusCelular/novo/id/<?php echo $discipulo->id?>" ><span class = "badge "  >Status: <?php echo $status['nome']; ?></span></a>
									<h5 class = "span8" >
										<a href= "/discipulo/atualizar/id/<?php echo is_object($lider) ? $lider->id : '';?>">
											Líder:<?php echo is_object($lider) ? $lider->nome : ''; ?></h5>
										</a>
							
							<p class = "span5" >Endereço: <?php echo $discipulo->endereco; ?></p>
							<p class = "span4" >Telefone: <?php echo $discipulo->telefone; ?></p>
							<p class = "span2" >Data Nasc.: <?php echo $dataN ; ?></p>
							<button class = "btn btn-mini span1 editar" ><i class = "icon-pencil" ></i></button></td>

							<div class = "oculto ui-widget" >
						  	<?php include 'discipulo/visao/formularioAtualizar.inc.php' ; ?>
							</div>
						</div>


				<?php endforeach ; ?>

						<?php endif ; ?>
				</div>
				
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

