<?php 
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
		<?php include 'incluidos/css.inc.php' ?>
		<?php include 'incluidos/js.inc.php' ?>
	</head>

	<body>
		<section class = "container-fluid">

		<nav> 
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
			
		<header>
		
		</header>

		<section>		
			<article>

			<?php if (isset($mensagem)) : ?>
					<div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
				  	<h4 class="alert-heading">
						<?php echo $mensagem ?>!
					</h4>
				   </div>
				<?php endif ; ?>
						<table class = "table">

							<caption><h3>Relatorios </h3></caption>

							<?php foreach ( $relatorios as $r ) : ?>

							<tr>
								<td class = "span3" ><?php echo date_format(date_create($r->dataEnvio),'d/m/Y  H:i:s')  ; ?></td>
								<td><h4><?php echo $r->titulo ; ?></h4></td>
							</tr>
							<tr>
								<td colspan = "2" ><?php echo $r->texto ; ?></td>
							</tr>

						<?php endforeach ; ?>
						</table>
				
			</article>
		
		</section>

		</section>
	</body>
</html>

