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

<script src = "modulos/discipulo/visao/js/pesquisa.js" ></script>

	</head>

	<body>
		<section class = "container">
		<nav> 
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
		<section>		
			<article>

			  <div class = "row" >
				<?php if ( $mensagem ) : ?>
					<div class = "alert alert-success span10" >	
						<strong>Mensagem:</strong> Atualizado com Sucesso 
						<a href="/discipulo/atualizar/id/<?php echo $mensagem['id']; ?>" > <?php echo $mensagem['nome'] ; ?></a>
					</div>
				<?php endif ; ?>
				</div>

				<?php require_once 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>

				<div class = "well">
						  <a class = "btn btn-success btn-large" href = "/discipulo/novoCompleto" >
									<i class = "icon-user icon-white" ></i> Novo Discípulo
							</a>
						  <a class = "btn btn-warning btn-large" href = "/celula/novo" >
									<i class = "icon-plus icon-white" ></i> Nova Célula
							</a>
				</div>
		
			</article>
		
		</section>

		</section>
	</body>
</html>

