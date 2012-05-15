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
					<form action = "/rede/atualizarFuncaoRede" method = "post"  class = "form-horizontal">

					<div class = "row" >
							  <fieldset class = "span6" >
								  <legend>Atualizar Funcao na Rede </legend>
							  
							  <div class="control-group ">
								  <label class = "control-label" >Nome:</label>
								  <div class = "controls" >
									  <input name = "nome"  value = "<?php echo $funcao['nome'] ; ?>" required >
								  </div>
								  </div>

								  <input type = "hidden" name = "id" value = "<?php echo $funcao['id']?>">

							  </fieldset>

							  <fieldset class = "span12" >
								  	<div class = "form-actions" >
								  		<button type = "submit" class = "btn btn-primary" >Atualizar</button>
								  		<button type = "reset" class = "btn" >Cancelar</button>
								  </div>
							  </fieldset>

					</div>

					</form>
				
			
			</article>
		
		</section>

		</section>
	</body>



</html>

