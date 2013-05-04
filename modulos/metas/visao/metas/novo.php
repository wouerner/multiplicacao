<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ; ?>
		<?php include 'incluidos/js.inc.php' ; ?>
	</head>

	<body>
		<section class = "container-fluid">

		<nav> 
			
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
			

		<section>		
			<article>

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>

				<div class = "row-fluid" >	
					<form class = "well form-horizontal" action = "/metas/metas/novo" method = "post">

						<legend><?php echo $discipulo->nome ?></legend>
						<input name = "discipuloId" type = "hidden" value = "<?php echo $discipuloId ; ?>" >


							<div class = "control-group">
								 <label class = "control-label" >Quantidade</label>	
								<div class = "controls">
								 <input name = "quantidade" type = "text" value = "" ?>
							  </div>
							</div>

		
							<div class = "control-group">
								<label class = "control-label">
									Inteervalo da meta:
								</label>

								<div class = "controls">
								<select name="intervaloMetas">
						<?php foreach ( $intervalos as $i) : ?>
								<option value = "<?php echo $i->id ?>" ><?php echo $i->nome ?></option>
						<?php endforeach ; ?>
								</select>

							</div>
							</div>
					<button class = "btn" type="submit">Salvar</button>
					</form>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

