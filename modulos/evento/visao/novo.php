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
				<fieldset>
					<legend>Criar Evento</legend>
					<form action = "/evento/novo" method = "post"  class = "form-inline">
						<div class = "control-group" >
								  <label>Nome:</label>
								  <input name = "nome" autofocus alt = "Nome" placeholder= "Nome do Evento">
						</div>
						<div class ="form-actions" >
						<button type = "submit" class = "btn btn-success" >Criar</button>
						<button type = "reset" class = "btn" >Cancelar</button>
						</div>

					</form>
				
				</fieldset>
			
			</article>
		
		</section>

		</section>
	</body>



</html>

