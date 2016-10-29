<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ?>
		<?php include 'incluidos/js.inc.php' ?>
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
					<div class = "well" >
						<table class = "table bordered-table">
						<caption><h3>Aviso</h3></caption>

						<?php foreach ( $avisos as $a ) : ?>
						<tr>
						<td> <?php echo $a['dataAviso'] ; ?></td><td><?php echo $a['nome'] ; ?> fez <?php echo $a['acao'] ; ?> <a href= "/<?php echo $a['modulo'] ; ?>/<?php echo $a['modulo'] ; ?>/detalhar/id/<?php echo $a['identificacao'] ; ?>"> <?php echo $a['modulo'] ; ?> </a></td>
						</tr>
							
						
						<?php endforeach ; ?>
						</table>
					</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

