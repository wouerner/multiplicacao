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

<div class = "row" >
	<div class = "span12" >
		<form method="post">	
				<fieldset>
						<legend>Relátorio Resumido</legend>
							<div class = "control-group " >
							<div class = "control-group span2" >
							<label>Idade </label> 
							<input class = "span1" value = "0" type = "" name = "idadeMinima" >
							<input class = "span1" value = "100" type = "" name = "idadeMaxima" >
							</div>

							<!-- <div class = "control-group span1" >
							 <label>Idade Maxima:</label> 
						
							</div> -->

							<div class = "control-group span2" >
							<label>Sexo:</label>
							
							<select class = "span2" name = "sexo" >
									<option value = "todos" >Todos</option>
									<option value = "m" >Masculino</option>
									<option value = "f" >Feminino</option>
							</select>
							</div>

							<div class = "control-group span2" >
							<label>Estado Civil:</label>	
							<select class = "span2" name = "estadoCivil" >
									<option value = "todos" >Todos</option>
								<?php foreach ( $estadoCivies as $estado) : ?>
									<option value = "<?php echo $estado['id'] ;?>" ><?php echo $estado['nome']?></option>
								<?php endforeach ; ?>
							 </select>
							</div>

							<div class = "control-group span2" >
							<label>Status:</label>	
								<select class = "span2" name = "tipoStatusCelular" >
									<option value = "todos" >Todos</option>
								<?php foreach ( $tipoStatusCelulares as $status) : ?>
									<option value = "<?php echo $status->id  ;?>" ><?php echo $status->nome?></option>
									<?php endforeach ; ?>

							</select>
							</div>

							<div class = "control-group span2" >
							<label>Célula:</label>	
								<select class = "span2" name = "celula" >
									<option value = "todos" >Todos</option>
								<?php foreach ( $celulas as $c) : ?>
									<option value = "<?php echo $c['id']  ;?>" ><?php echo $c['nome'] ?></option>
									<?php endforeach ; ?>

							</select>
							</div>

							<div class = "control-group span2" >
							<label>Rede:</label>	
								<select class = "span2" name = "rede" >
									<option value = "todos" >Todos</option>
								<?php foreach ( $tipoRedes as $tp) : ?>
									<option value = "<?php echo $tp['id']  ;?>" ><?php echo $tp['nome'] ?></option>
									<?php endforeach ; ?>

							</select>
							</div>

							<div class = "form-actions span11" >
						<button class = "btn" type="submit">Gerar</button>
							</div>
					</div>
				</fieldset>
		</form>
				
	</div>		
	</div>		
			</article>
		
		</section>

		</section>
	</body>
</html>

