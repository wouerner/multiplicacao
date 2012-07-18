<?php 
				$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ; 
				$_SESSION['mensagem']=  isset($_SESSION['mensagem']) ? NULL : NULL;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<style type="text/css">
		   @import url("../../../ext/twitter-bootstrap/bootstrap.css");
			@import url("../../../ext/jquery-ui/css/bootstrap/jquery-ui.css");
		   @import url("../../../incluidos/css/estilo.css");
		</style>
		<script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
		<script src="../../../ext/jquery-ui/js/jquery-ui.js"></script>
		<script src="../../../ext/jquery-ui/development-bundle/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
		<script src="../../../ext/jquery/jquery.maskedinput.js"></script>
		<script src="../modulos/discipulo/visao/js/novo.js"></script>
		<script src = "/modulos/discipulo/visao/js/pesquisa.js" ></script>

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
			
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
		<section>		
			<article>

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>


				<?php if ( $mensagem ) : ?>
			  <div class = "row" >
					<div class = "span12" >
					<div class = "alert alert-<?php echo $mensagem[000]['classe'] ; ?>" >	
					<strong>Mensagem:</strong> <?php echo $mensagem[000]['mensagem'] ; ?> 
						<?php if (isset($mensagem['discipulo'])) : ?>
								<a href = "/discipulo/atualizar/id/<?php echo $mensagem['discipulo']['id']?>" ><?php echo $mensagem['discipulo']['nome']?></a>
						<?php endif ; ?>
				</div>
				</div>
				</div>
				<?php endif ; ?>

			  <div class = "row" >

						<h3 class = "span12" > Total de discípulos: <?php echo $totalDiscipulos?></h3>
				<?php foreach ( $discipulos as $discipulo ) : ?>
						<?php $lider = $discipulo->getLider() ; ?>
						<?php $status = $discipulo->getStatusCelular() ; ?>
						<?php $dataN = $discipulo->getDataNascimento()->format('d/m/Y') ; ?>

						  <div class = "span12 borda" >

								<h3 class = "span8" ><?php echo $discipulo->nome ; ?></h3>
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
					<div class = "span12" >
						<?php  discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos ,
								  															$quantidadePorPagina ,
																							$pagina ) ; ?>
					</div>
				</div>
						</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

