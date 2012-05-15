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

			<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>

			<table>
				<caption><h3>Detalhes do Discipulos</h3></caption>

				<tr>	
					<td colspan = "2" >
						<h3><?php echo $discipulo->nome ; ?></h3>
					</td>
					<td>
						<span class="badge"> <?php  echo $statusCelular['nome'] ; ?></span> 
					</td>
				</tr>

				<tr><td>Telefone:<?php echo $discipulo->telefone ; ?></td>
					 <td>E-mail:<?php echo $discipulo->email ; ?></td>
				</tr>

				<tr><td colspan = "2" >Endereço: <?php  echo $discipulo->endereco ; ?></td></tr>

				<tr><td colspan = "2" >Líder da Célula: 
						<?php foreach ( $liderCelula as $celula) :?>
						<a href="/celula/detalhar/id/<?php echo $celula['id'] ; ?>">
							<?php echo $celula['nomeCelula'] ; ?> 
						</a> |
						<?php endforeach ; ?>
						  </a>
						</td>
				</tr>

				<tr><td colspan = "2" >Participa da Célula: 
						<a href="/celula/detalhar/id/<?php echo $discipulo->celula ; ?>">
							<?php echo $participaCelula['nomeCelula'] ; ?>
						</a>
					</td>
				</tr>

				<tr>
					<td> 
				<?php foreach ( $eventosDiscipulo as $evento) :?>
						<a href="/celula/detalhar/id/<?php echo $evento['id'] ; ?>">
							<?php echo $evento['nome'] ; ?> 
						</a> |
				<?php endforeach ; ?>
					</td>
				</tr>

				<tr>
					<td> 
				<?php foreach ( $ministerios as $ministerio) :?>
							<?php echo $ministerio['funcao'] ; ?>  
							<?php echo $ministerio['ministerio'] ; ?> 
						 |
				<?php endforeach ; ?>
					</td>
				</tr>

					<?php require 'discipulo/visao/menuDiscipulo.inc.php' ; ?>
				</table>
				
			
			</article>
		
		</section>

		</section>
	</body>
</html>

