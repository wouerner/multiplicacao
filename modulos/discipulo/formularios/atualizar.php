<?php
session_start();
include '../../../config/autoload.php' ; 
use discipulo\Modelo\Discipulo;

$id = $_GET['id'];


$discipulo = new Discipulo();

$discipulo->id = $id;

$discipulo = $discipulo->listarUm();
?> 

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
		Olá <a href="detalhar.php?id=<?php echo $_SESSION['usuario_id'] ; ?>"><?php echo $_SESSION['usuario_nome'] ; ?></a> |
			<a href="../../seguranca/acao/sair.php">Sair</a>
			<?php include '../visao/menu.inc.php' ; ?>	
			</nav>
		</header>

		<section>		
			<article>
				<fieldset>
					<legend>Atualizar Discipulo</legend>
					<form action = "../acao/atualizar.php" method = "post"  class = "form-stacked">
						<label>Nome:</label>
						<input name = "nome"  value = "<?php echo $discipulo['nome'] ; ?>" >
						<label>Telefone:</label>
						<input name = "telefone" value = "<?php echo $discipulo['telefone']?>" >
						<label>Endereço:</label>
						<input name = "endereco" value = "<?php echo $discipulo['endereco']?>">
						<label>E-mail:</label>
						<input name = "email" value = "<?php echo $discipulo['email']?>">

						<label>Nível</label>
						<input name = "nivel" value = "<?php echo $discipulo['nivel']?>">
						<label>Líder</label>
						<input name = "lider" value = "<?php echo $discipulo['lider']?>">
						<label>Célula</label>
						<input name = "celula" value = "<?php echo $discipulo['celula']?>">
						

						<label>Usuario:</label>
						<input name = "usuario" value = "<?php echo $discipulo['usuario']?>">
						<label>Senha:</label>
						<input name = "senha" >
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

