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
					<legend>Criar Discipulo</legend>
					<form action = "/discipulo/novo" method = "post"  class = "form-horizontal">
				<fieldset>
						<div class = "control-group" >

						<label class = "control-label" >Nome:</label>
						<div class = "controls" >
						<input name = "nome" autofocus alt = "Nome" placeholder= "Nome completo">
						</div>
						</div>
						
						<div class = "control-group" >
						<label class = "control-label" >Telefone:</label>
						<div class = "controls" >
						<input name = "telefone" type = "tel" placeholder= "(00)9999-9999" pattern="\([0-9]{2}\)[0-9]{4}\-[0-9]{4}" maxlength="13" >
						</div>
						</div>

						<div class = "control-group" >
						<label class = "control-label" >Endereço:</label>
						<div class = "controls" >
						<input name = "endereco" >
						</div>
						</div>

						<div class = "control-group" >
						<label class = "control-label" >E-mail:</label>
						<div class = "controls" >
						<input name = "email" type = "email" placeholder= "Digite o seu e-mail" required>
						</div>
						</div>

						<div class = "control-group" >
						<label class = "control-label" >Senha:</label>
						<div class = "controls" >
						<input name = "senha" type = "password">
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
