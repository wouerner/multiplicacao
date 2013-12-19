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
					<legend>Ofertas</legend>
					<form action = "/oferta/novo" method = "post"  class = "form-horizontal">
				<fieldset>

						<h2><strong><a href = "/discipulo/detalhar/id/<?php echo $discipulo['id']?>" ><?php echo $discipulo['nome']; ?></a></strong></h2>
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
							<input class = "span1" type = "date" name= "dia" maxlength="2" required >/
							<input class = "span1" type = "date" name= "mes" maxlength="2" required >/
							<input class = "span1" type = "date" name= "ano" maxlength="4" required >
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
							
						<table class = "table" >
								<?php foreach ($ofertasDiscipulo as $oferta) : ?>
									<tr>
										<td>
									<?php echo $oferta['nome'] ; ?> 
										</td>
										<td>
									<?php echo $of = implode ('/',array_reverse(explode('-',$oferta['data']))) ; ?> 
										</td>
										<td>
										<a class = "btn btn-danger" href="/oferta/excluir/id/<?php echo $oferta['0'] ; ?>/<?php echo $oferta['discipuloId']?>" >Excluir</a>
										</td>
									</tr>
								<?php endforeach ; ?>
						</table>
			
			</article>
		
		</section>

		</section>
	</body>

</html>
