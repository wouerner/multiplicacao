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
					<legend>Criar Discipulo</legend>
					<form action = "/discipulo/novo" method = "post"  class = "form-stacked">
						<label>Nome:</label>
						<input name = "nome" autofocus alt = "Nome" placeholder= "Nome completo">
						<label>Telefone:</label>
						<input name = "telefone" type = "tel" placeholder= "(00)9999-9999" pattern="\([0-9]{2}\)[0-9]{4}\-[0-9]{4}" maxlength="13" >
						<label>Endereço:</label>
						<input name = "endereco" >
						<label>E-mail:</label>
						<input name = "email" type = "email" placeholder= "Digite o seu e-mail" required>
						<label>Usuario:</label>
						<input name = "usuario" >
						<label>Senha:</label>
						<input name = "senha" type = "password">

						<button type = "submit" class = "btn success" >Criar</button>
						<button type = "reset" class = "btn" >Cancelar</button>

					</form>
				
				</fieldset>
			
			</article>
		
		</section>

		</section>
	</body>



</html>

