<?php 
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;

?>
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

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>


				<div class = "row-fluid" >	
				<div class = "span12" >	
						<table class = "well table table-condensed">
						<caption>
							<h3>Lista de Tipo de Rede</h3>
						</caption>
						<thead>
						<tr>
							<th>#</th>
							<th>Nome</th>
							<th>Ações</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ( $redes as $rede) : ?>

						<tr>
							<td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
							<td><a href="/rede/rede/detalharTipoRede/id/<?php echo $rede->id?>" ><?php echo $rede->nome ; ?> </a></td>
							<?php require 'rede/visao/tipoRede/menu.inc.php' ; ?>
						</tr>
						
						<?php endforeach ; ?>
						</tbody>
						</table>
			</div>
			</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

