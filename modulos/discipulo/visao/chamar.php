<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<style type="text/css">
		   @import url("../../../ext/twitter-bootstrap/bootstrap.css");
		   @import url("../../../incluidos/css/estilo.css");
			@import url("../../../ext/jquery-ui/css/ui-lightness/jquery-ui.css");
		</style>
		<script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
		<script src="../../../ext/jquery-ui/js/jquery-ui.js"></script>
		<script src="../../../ext/jquery-ui/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
			  //$(".oculto form").hide();

	/*		  $(".mostra").click(
			  					function($this){
										  //alert('oi');
										  //alert($this);
										  $(this).next(".oculto").toggle();
										  //$(this).toggle(function ($this) {
										  	//	$(this).next(".oculto").hide();
										  
										 // });

								}
					);
	});*/

		$(function() {

				  $( ".dataNascimento" ).datepicker();
		});

		/*$(function() {

				  $( ".oculto" ).dialog({autoOpen:false, 
							 modal:true });
	});*/

		/*$( ".mostra" )
			//.button()
			.click(function() {
				$( this ).next("div.oculto").dialog( { width : 960} );
			});
	*/

jQuery(function($) {
  $('.table').each(function() {  
    $.data(this, 'dialog', 
      $(this).next('.table + div.oculto').dialog({
        autoOpen: false,  
        modal: true,  
        width: 960,  
        draggable: false  

      })
    );  
  }).click(function() {  
      $.data(this, 'dialog').dialog('open');  
      return false;  
  });  
}); 
	});
	</script>
		<script src="/modulos/discipulo/visao/js/combobox.js"></script>
		<script src="/modulos/discipulo/visao/js/comboboxCelula.js"></script>
	</head>

	<body>
		<section class = "container">

		<nav> 
			<?php require 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
			

		<section>		
			<article>

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
			<div class = "row" >	
				<div class = "span12" >	
						<?php if (is_null($nome)) : ?>
							<h3>Faça sua pesquisa!</h3>
						<?php else : ?>

						<table class = "table bordered-table">
						<caption><h3>Lista de Discipulos</h3></caption>

						<?php foreach ( $discipulos as $discipulo) : ?>


						 <?php $lider = $discipulo->getLider() ; ?>
						<?php $status = $discipulo->getStatusCelular() ; ?>
						 <?php $dataN = $discipulo->getDataNascimento()->format('d/m/Y') ; ?>

						  <div class = "row" >
						  <div class = "span12" >

							<table class = "table table-bordered table-condensed tabelaLista" >
								<tr>
									<td class = "span1" >
									<button class = "btn btn-mini span1" ><i class = "icon-pencil" ></i></button></td>
								<td class = "span5" >
								<h4 class = "" ><?php echo $discipulo->nome ; ?></h4></td>
							<td class = "span3" >Status: <?php echo $status['nome'] ; ?></td>
							<td colspan = "2" >Líder:<?php echo is_object($lider) ? $lider->nome : ''; ?></td>
								</tr>
								<tr>
							<td colspan = "2" class = "span4" >Endereço: <?php echo $discipulo->endereco; ?></td>
							<td>Telefone: <?php echo $discipulo->telefone; ?></td>
							<td>Data Nasc.: <?php echo $dataN ; ?></td>
								</tr>
							</table>

							<div class = "oculto ui-widget" >
						  	<?php include 'discipulo/visao/formularioAtualizar.inc.php' ; ?>
							</div>
						</div>
						</div>
							
						<?php endforeach ; ?>
						<?php endif ; ?>
						</table>
				</div>
				
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

