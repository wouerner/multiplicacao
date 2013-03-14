<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php'?>
		<?php include 'incluidos/js.inc.php'?>
		<script>
		$(function() {

		  $( ".data" ).datepicker({showWeek:true});
		});
	
		</script>

		<script>
		$(function() {

		  $( ".tempo" ).timepicker();
		});
	
		</script>
	</head>

	<body>
		<section class = "container-fluid">
		<header>
			<nav>
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
			</nav>
		
		</header>

		<section>		
			<article>
				<div class = "well" >

					<form action = "/celula/temaRelatorioCelula/novo" method = "post"  class = "form-horizontal">
				<fieldset>
					<legend>Tema Relatório de Célula</legend>

					<div class = "control-group" >
						<label class = "control-label" >Nome:</label>
						<div class = "controls" >
						<input type = "text" name = "nome" autofocus alt = "Nome" placeholder= "Nome do Tema" required>
						</div>
					</div>	

					<div class = "control-group" >
						<label class = "control-label" >Data Inicio:</label>
						<div class = "controls" >
						<input  type = "text" name = "dataInicio" class = "data" required >
						<input type = "text"  name = "tempoInicio" class = "tempo" value = "00:00"   >
						</div>
					</div>	

					<div class = "control-group" >
						<label class = "control-label" >Data Fim:</label>
						<div class = "controls" >
						<input  class = "data" type = "text" name = "dataFim" required >
						<input type = "text"  name = "tempoFim" class = "tempo" value = "23:59"   >
						</div>
					</div>	


						</div>
					</div>	
						<div class = "form-actions" >
						<button type = "submit" class = "btn btn-success" >Salvar</button>
						<button type = "reset" class = "btn" >Limpar</button>
						</div>
				</div>
				</fieldset>

					</form>
				
		</div>	
			</article>
		
		</section>

		</section>
	</body>



</html>

