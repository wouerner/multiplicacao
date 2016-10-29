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

				<?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>

				<div class = "row-fluid" >	
					<form class = "well form-horizontal" action = "/encontroComDeus/equipe/novoEquipe" method = "post">
						<input name = "encontroId" type = "hidden" value = "<?php echo $encontroId ; ?>" >

							<div class = "control-group">
								<label class = "control-label" >Tipo Equipe: </label>
								<div class = "controls">
							<select name = "tipoEquipeId" >
							<?php foreach ( $tiposEquipe as $t ) :?>
								<option  value = "<?php echo $t->id ; ?>" ><?php echo $t->nome?></option>
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

