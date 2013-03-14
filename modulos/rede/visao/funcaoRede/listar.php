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
				<div class = "span12" >	
					<div class = "well" >
						<table class = "table bordered-table">
						<caption><h4>Lista de Funções na Rede</h4></caption>

						<?php foreach ( $funcoes as $funcao) : ?>

						<tr><td><a href="/rede/detalharFuncao/id/<?php echo $funcao['id']?>" ><?php echo $funcao['nome'] ; ?></a></td>
							<?php require 'rede/visao/funcaoRede/menu.inc.php' ; ?>
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

