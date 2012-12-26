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

		<nav> 
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
			
		<header>
		
		</header>

		<section>		
			<article>

						<table class = "table table-bordered">

						<caption><h3>Célula do <a href = "/discipulo/atualizar/id/<?php echo $lider->id?>" ><?php echo $lider->nome?></h3></a></caption>


							<tr><td class = "span6" ><h4>Nome da Célula: <?php echo $celula->nome ; ?> </h4></td>
								<?php require 'celula/visao/menuCelula.inc.php' ; ?></tr>
							<tr>
								<td>Endereço:<?php echo $celula->endereco ; ?>	</td> 
								<td>Horario:<?php echo $celula->horarioFuncionamento ; ?></td>
							</tr>
								
							
							<tr>
							</table>

							<table class = "table table-bordered table-condensed" >
							<caption><h4>Lista de discipulos</h4></caption>

							<?php $cont= 0 ?>

							<?php foreach ($discipulos as $discipulo) : ?>
							<?php  $cont++ ; ?>
										
										<?php if ($cont ==0) :?>
											<tr>
										<?php endif; ?>

											<td> <a href = "/discipulo/detalhar/id/<?php echo $discipulo['id'] ; ?>"> <?php echo $discipulo['nome'] ;?></a></td>

										<?php if ($cont ==4) :?>
											</tr>
											<?php $cont=0?>
										<?php endif; ?>
									
							<?php endforeach ; ?>
						</table>
				
			</article>
		
		</section>

		</section>
	</body>
</html>

