<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<style type="text/css">
		   @import url("../../../ext/twitter-bootstrap/bootstrap.css");
		   @import url("../../../incluidos/css/estilo.css");
		</style>
		<script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
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
					<form action = "/admissao/atualizarTipoAdmissao" method = "post"  class = "form-inline">
				<fieldset>
					<legend>Atualizar Evento</legend>

						<label>Nome:</label>
						<input name = "nome"  value = "<?php echo $tipoAdmissao['nome'] ; ?>" >
						<input type = "hidden" name = "id"  value = "<?php echo $tipoAdmissao['id'] ; ?>" >

						<div class = "form-actions" >
						<a class = "btn" href = "/admissao/listarTipoAdmissao"  ><i class = "icon-chevron-left" ></i></a>
						<button type = "submit" class = "btn btn-primary " >Atualizar</button>
							</div>
						</fieldset>

					</form>
				
			</article>
		
		</section>

		</section>
	</body>



</html>

