<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ; ?>
		<?php include 'incluidos/js.inc.php' ; ?>

<link rel="stylesheet" type="text/css" href="/ext/markitup/markitup/skins/markitup/style.css" />
<link rel="stylesheet" type="text/css" href="/ext/markitup/markitup/sets/default/style.css" />

		<script src="/modulos/discipulo/visao/js/combobox.js"></script>

<script type="text/javascript" src="/ext/markitup/markitup/jquery.markitup.js"></script>
<script type="text/javascript" src="/ext/markitup/markitup/sets/default/set.js"></script>

<script type="text/javascript" >
   $(document).ready(function() {
      $("#markItUp").markItUp(mySettings);
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
				
		    <form class="well " action = "/celula/relatorio/novo" method = "post"  >
						<div class="row-fluid">
						<div class="span3">
							<label>Titulo</label>
							<input name = "titulo" type="text" class="input-block-level" maxlength = "45" placeholder="Título do Relatório" >

							<label>Tema Relatório Célula</label>
							<select class="input-block-level" name = "temaRelatorioCelulaId" required>
								<?php foreach( $temas as $t ) : ?>
								<option value = "<?php echo $t->id ?>" ><?php echo $t->nome ; ?></option>
								<?php endforeach ; ?>
							</select>							

							<label>Data Envio</label>
							<input name = "dataEnvio" type="text" class="input-block-level" placeholder="" value = "<?php echo $dataEnvio ; ?>" disabled >
							<label>Líder</label>
							<input name = "liderId" type="text" class="input-block-level" placeholder="" value = "<?php echo $lider->nome ; ?>" disabled >
							<label>Célula</label>
							<input name = "celula" type="text" class="input-block-level" placeholder="" value = "<?php echo $celula->nome ; ?>" disabled >

							<input name = "celulaId" type="hidden" class="span3" placeholder="" value = "<?php echo $celula->id ; ?>">
							<input name = "lider" type="hidden" class="span3" placeholder="" value = "<?php echo $lider->id ; ?>" >

						</div>

						<div class="span9">
							<label>Relatório</label>
							<textarea id = "markItUp" name="texto"  class="input-block-level" rows="10" required ></textarea>
						</div>
						<div class = "row-fluid" >
						<div class = "span12" >	
						<table class = "table" >
							<caption>Paticipação Discipulos</caption>
							<?php foreach ( $discipulos as $d ) : ?>
							<tr> <td><input name = "discipulos[]" type = "checkbox" value = "<?php echo $d['id'] ; ?>" > <?php echo $d['nome'] ; ?> </td> </tr>
							<?php endforeach ; ?>
						</table>
						</div>
						</div>

						<button type="submit" class="btn btn-primary ">enviar</button>
						<a href="/celula/celula"  class="btn  right">voltar</a>
						</div>
    </form>	
			</article>
		
		</section>

		</section>
	</body>



</html>

