<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php ?>
	</head>

	<body>
		<section class = "container-fluid">

		<?php include 'incluidos/css.inc.php'?> 
		<?php include 'incluidos/js.inc.php'?> 
			
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
			

		<section>		
			<article>

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>

				<div class = "row-fluid" >	
					<div class = "span12" >
<div class = "well" >
						<table class = "table bordered-table">
						<caption><h3>Lista de Discipulos da rede <?php echo $tipoRede->nome ; ?></h3></caption>
						<tr>
							<th>Nº</th>
							<th>Líder</th>
							<th>Nome</th>
						</tr>
						<?php foreach ( $redeMembros as $discipulo) : ?>

						<tr>
							<td><?php echo  $cont++  ?></td>
							<td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->getLider()->id ?>" ><?php echo $discipulo->getLider()->nome ; ?></a></td>
							<td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ?>" ><?php echo $discipulo->nome ; ?></a></td>
						</tr>
							
						
						<?php endforeach ; ?>
						</table>
					<div class = "form-actions" >	
						<?php //discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
					</div>
					</div>
			</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

