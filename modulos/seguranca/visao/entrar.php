<?php

/*$mensagem=null;
if(!empty($_SESSION['mensagem'])){
	$mensagem = $_SESSION['mensagem'];
	unset($_SESSION['mensagem']);
}*/

//var_dump($_SESSION['erros']);

//$erros = $_SESSION['erros'];

$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL;
$erros =  isset($_SESSION['erros']) ? $_SESSION['erros'] : NULL;

unset($_SESSION['mensagem']);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Autenticação</title>
		<link href="../../../ext/twitter-bootstrap/bootstrap.css" rel="stylesheet" type="text/css" />	
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  </head>
  <body>


		<div class = "container">
						<h2>Multiplicação</h2>
				<form class="form-stacked" method="post" accept-charset="utf-8" action ="/seguranca/entrar" >
						<?php echo $mensagem ; ?>
							<label  for="login">Usuário ou E-Mail:</label>
							<input type="text" name="usuario" class="text meddium" />
							<label class="desc" for="senha">Senha:</label>
							<input type="password" name="senha" class="text " />
							<button type="submit" class="btn">Entrar</button>
				</form>
			</div>

		</div>
  </body>
</html>
