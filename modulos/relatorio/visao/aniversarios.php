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
			
		<header>
		
		</header>

		<section>		
			<article>
	

			<form action = "/relatorio/relatorio/aniversariantes" method= "post">	
					<label>Mês</label>
					<select name = "data" >
						<option value="1">Janeiro</option>
						<option value="2">Fevereiro</option>
						<option value="3">Março</option>
						<option value="4">Abril</option>
						<option value="5">Maio</option>
						<option value="6">Junho</option>
						<option value="7">Julho</option>
						<option value="8">Agosto</option>
						<option value="9">Setembro</option>
						<option value="10">Outubro</option>
						<option value="11">Novembro</option>
						<option value="12">Dezembro</option>
					</select>

					<button class = "btn" type = "sunmit" >Gerar</button>
			</form>

				
			</article>
		
		</section>

		</section>
	</body>
</html>

