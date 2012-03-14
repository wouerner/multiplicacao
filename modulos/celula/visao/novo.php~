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
		<header>
			<nav>
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
			</nav>
		
		</header>

		<section>		
			<article>
				<fieldset>
					<legend>Criar Célula</legend>
					<form action = "/celula/novo" method = "post"  class = "form-horizontal">

						<label>Nome:</label>
						<input name = "nome" autofocus alt = "Nome" placeholder= "Nome da Célula">

						<label>Horario:</label>
						<input name = "horarioFuncionamento" >

						<label>Endereço:</label>
						<input name = "endereco" >

						<label>Líder</label>
						<select name = "lider" >
						<?php foreach($lideres as $lider) : ?>
						<option value = "<?php echo $lider['id']?>"><?php echo $lider['nome']?> </option>
						<?php endforeach ; ?>

						</select>

						<button type = "submit" class = "btn btn-primary" >Criar</button>
						<button type = "reset" class = "btn" >Cancelar</button>

					</form>
				
				</fieldset>
			
			</article>
		
		</section>

		</section>
	</body>



</html>

