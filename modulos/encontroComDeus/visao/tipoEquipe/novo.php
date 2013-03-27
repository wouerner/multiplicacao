<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ; ?>
		<?php include 'incluidos/js.inc.php' ; ?>
	</head>

	<body>
		<section class = "container-fluid">
		<header>
			<nav>
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
			</nav>
		
		</header>

		<section>		
			<article>
					<form action = "/encontroComDeus/tipoEquipe/novo" method = "post"  class = "form-horizontal">
					<legend>Nova Tipo de Equipe </legend>
				<fieldset>
						<div class = "control-group" >

						<label class = "control-label" >Nome da Equipe:</label>
						<div class = "controls" >
							<input name = "nome" type = "text" autofocus alt = "Nome" placeholder= "">
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

