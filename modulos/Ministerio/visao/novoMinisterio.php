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
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
			</nav>
		
		</header>

		<section>		
			<article>
					<legend>Novo Ministério</legend>
					<form action = "/ministerio/novoMinisterio" method = "post"  class = "form-horizontal">
				<fieldset>
						<div class = "control-group" >

						<label class = "control-label" >Nome do Ministério:</label>
						<div class = "controls" >
							<input name = "nome" autofocus alt = "Nome" placeholder= "" required>
						</div>
						</div>
						
						<div class = "form-actions" >
						<button type = "submit" class = "btn btn-success" >Criar</button>
						<button type = "reset" class = "btn" >Limpar</button>
						</div>
						</div>
				</fieldset>
					</form>
				
			
			</article>
		
		</section>

		</section>
	</body>



</html>

