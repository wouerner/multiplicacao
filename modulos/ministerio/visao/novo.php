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
					<form action = "/oferta/novo" method = "post"  class = "form-horizontal">
				<fieldset>

						<h2>oferta do discipulo: <strong><?php echo $discipulo['nome']; ?></strong></h2>
						<input type = "hidden" name = "discipuloId" value ="<?php echo $discipulo['id'] ; ?>" >	

						<div class = "control-group" >
						<label class = "control-label" >Tipo da Oferta</label>
						<div class = "controls" >
							<select name = "tipoOfertaId" >
								<?php foreach ($tiposOfertas as $tipoOferta) : ?>
									<option value = "<?php echo $tipoOferta ['id'] ; ?>" ><?php echo $tipoOferta ['nome'] ; ?></option>
								<?php endforeach ; ?>
							</select>
						</div>
						</div>

						<div class = "control-group" >
						<label class = "control-label" >Data da Oferta: </label>
						<div class = "controls" >
							<input type = "date" name= "dataOferta" >
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
