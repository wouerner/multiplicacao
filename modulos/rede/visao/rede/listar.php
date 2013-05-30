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
							<th>Meta </th>
						</tr>
						<?php foreach ( $redeMembros as $discipulo) : ?>

						<tr>
							<td><?php echo  $cont++  ?></td>
								<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
							<td><a href="/discipulo/discipulo/detalhar/id/<?php echo is_object($lider=$discipulo->getLider()) ? $lider->id : '' ; ?>"><?php echo $lider->nome ; ?></a></td>
							<td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ?>" ><?php echo $discipulo->nome ; ?></a></td>
							<td><?php echo is_object($meta = $discipulo->getMeta()) ? $meta->quantidade : 0 ?></td> 
							<?php $metaTotal+= is_object($meta) ? $meta->quantidade : 0?>

							<?php else : ?>
							<td><?php echo is_object($lider=$discipulo->getLider()) ? $lider->nome : '' ; ?></td>
							<td><?php echo $discipulo->nome ; ?></td>
							<td><?php echo is_object($meta = $discipulo->getMeta()) ? $meta->quantidade : 0 ?></td> <?php $metaTotal+= is_object($meta)? $meta->quantidade : 0 ?>
							<?php endif ; ?>
						</tr>
						
						<?php endforeach ; ?>
						<tr>
	           <td colspan = "" ></td>
	           <td colspan = "" >Total</td>
	           <td colspan = "" ><?php echo $metaTotal?></td>
            </tr>
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

