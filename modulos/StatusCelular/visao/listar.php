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

				<div class = "row" >	
				<div class = "span12" >	
						<table class = "table bordered-table">
						<caption><h3>Lista de Discipulos</h3></caption>

						<?php foreach ( $discipulos as $discipulo) : ?>

						<tr><td><a href="/discipulo/detalhar/id/<?php echo $discipulo['id']?>" ><h2><?php echo $discipulo['nome'] ; ?> </h2></a></td>
							<?php require 'Discipulo/visao/menuDiscipulo.inc.php' ; ?>
						</tr>
						<tr><td>Telefone:<?php echo $discipulo['telefone'] ; ?></td> <td>E-mail:<?php echo $discipulo['email'] ; ?></td></tr>
						<tr><td colspan = "2" >Endereço: <?php  echo $discipulo['endereco'] ; ?></td></tr>
							
						
						<?php endforeach ; ?>
						</table>
					<div class = "form-actions" >	
						<?php discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
					</div>
					</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>

