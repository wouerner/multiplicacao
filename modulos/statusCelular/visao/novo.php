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
					<legend>Atualizar Celular</legend>
					<form action = "/statusCelular/novo" method = "post"  class = "form-horizontal">
				<fieldset>
						<div class = "control-group" >

						

						<input type = "hidden" name = "discipuloId" value ="<?php echo $discipulo['id'] ; ?>" >	

						<label class = "control-label" ><strong><?php echo $discipulo['nome']; ?></strong> Tipo do Status:</label>
						<div class = "controls" >
							<select name = "tipoStatusCelular" >
									<option value = "<?php echo $statusCelularDiscipulo ['id'] ; ?>" ><?php echo $statusCelularDiscipulo ['nome'] ; ?></option>
									<option value = "" >-------------</option>
								<?php foreach ($tiposStatusCelulares as $tipoStatusCelular) : ?>
									<option value = "<?php echo $tipoStatusCelular ['id'] ; ?>" ><?php echo $tipoStatusCelular ['nome'] ; ?></option>
								<?php endforeach ; ?>
							</select>
						
						</div>
						</div>
						
						<div class = "form-actions" >
						<button type = "submit" class = "btn btn-primary" >Atualizar</button>
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
