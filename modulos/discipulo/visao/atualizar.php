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
				<?php require 'modulos/menu/visao/menu.inc.php' ; ?>
			</nav>
		</header>

		<section>		
			<article>
				<fieldset>
					<legend>Atualizar Discipulo</legend>
					<form action = "/discipulo/atualizar" method = "post"  class = "form-horizontal">
						<label>Nome:</label>
						<input name = "nome"  value = "<?php echo $discipulo['nome'] ; ?>" >

						<label>Ativo:</label>
						<input name = "ativo" type = "checkbox"  
							value = "<?php echo ($discipulo['ativo'] != TRUE )? TRUE : 0 ; ?>" <?php  echo ($discipulo['ativo'] == TRUE )? "checked" :"" ; ?> >

						<label>Telefone:</label>
						<input name = "telefone"  value = "<?php echo $discipulo['telefone']?>" >
						<label>Endereço:</label>
						<input name = "endereco" value = "<?php echo $discipulo['endereco']?>">
						<label>E-mail:</label>
						<input name = "email" type = "email" value = "<?php echo $discipulo['email']?>">

						<label>Nível</label>
						<input name = "nivel" value = "<?php echo $discipulo['nivel']?>">

						<label>Líder</label>
						<select name = "lider" required >

						<option value = "<?php echo $lider['id']?>"><?php echo $lider['nome']?> </option>
						<option>--------- </option>

						<?php foreach($lideres as $lider) : ?>
						<option value = "<?php echo $lider['id']?>"><?php echo $lider['nome']?> </option>
						<?php endforeach ; ?>

						</select>

						<label>Célula</label>

						<select name = "celula" required >
						<option value = "<?php echo $celula['id']?>"><?php echo $celula['nome']?> </option>
						<option>--------- </option>

						<?php foreach($celulas as $celula) : ?>
						<option value = "<?php echo $celula['id']?>"><?php echo $celula['nome']?> </option>
						<?php endforeach ; ?>

						</select>


						<input type = "hidden" name = "id" value = "<?php echo $discipulo['id']?>">

						<fieldset>
							<legend>Controle</legend>
						<button type = "submit" class = "btn success" >Atualizar</button>
						<button type = "reset" class = "btn" >Cancelar</button>
						</fieldset>

					</form>
				
				</fieldset>
			
			</article>
		
		</section>

		</section>
	</body>



</html>
