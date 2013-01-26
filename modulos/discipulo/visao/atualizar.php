<?php 

$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : '';
unset($_SESSION['mensagem']) ;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<style type="text/css">
		   @import url("../../../../ext/twitter-bootstrap/bootstrap.css");
		   @import url("../../../../incluidos/css/estilo.css");
			@import url("../../../../ext/jquery-ui/css/bootstrap/jquery-ui.css");
		</style>

		<script src= "../../../../ext/jquery/jquery-1.7.1.min.js"></script>
		<script src= "../../../ext/jquery/jquery.maskedinput.js"> </script>

		<script src= "../../../ext/jquery-ui/js/jquery-ui.js"> </script>
		<script src= "../../../ext/jquery-ui/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"> </script>

		<script src= "../../../../ext/twitter-bootstrap/js/bootstrap.min.js"> </script>

		<script>

		jQuery(function($){
   	$("#telefone").mask("(99) 9999-9999");
   	$("#dataNascimento").mask("99/99/9999");
		});

		$(function() {

				  $( "#dataNascimento" ).datepicker();
		});

// Status Celular dialog
		/*$(function() {
				  $( "#dialog-form" ).dialog({  autoOpen : false,
							 								height: 300,
															width: 500,
															modal: true,
				 									 });

				  $( "#statusCelular" )
							 .button()
							.click( function(){
										$("#dialog-form").dialog("open");
				  });

		});

// Admissao Dialog 
		$(function() {
				  $( "#formularioAdmissao" ).dialog({  autoOpen : false,
							 								height: 300,
															width: 500,
															modal: true,
				 									 });

				  $( "#butaoAdmissao" )
							 .button()
							.click( function(){
										$("#formularioAdmissao").dialog("open");
				  });

		});

// rede Dialog 
		$(function() {
				  $( "#formularioRede" ).dialog({  autoOpen : false,
							 								height: 300,
															width: 500,
															modal: true,
				 									 });

				  $( "#butaoRede" )
							 .button()
							.click( function(){
										$("#formularioRede").dialog("open");
				  });

		});*/
		</script>
		<script src="/modulos/discipulo/visao/js/combobox.js"></script>
		<script src="/modulos/discipulo/visao/js/comboboxCelula.js"></script>

	</head>

	<body>
		<section class = "container">
		<header>
			<nav>
				<?php require 'modulos/menu/visao/menu.inc.php' ; ?>
			</nav>
		</header>

		<section>		

			<article>

				<?php if ($mensagem) : ?>
					<div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
				  	<h4 class="alert-heading">
						<?php echo $mensagem ?>!
					</h4>
				   </div>
				<?php endif ; ?>

				<?php include 'discipulo/visao/formularioAtualizar.inc.php' ; ?>
			</article>
		</section>

	</div>	
		</section>
	</body>



</html>

