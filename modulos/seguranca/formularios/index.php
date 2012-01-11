<?php

session_start();

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
		<link href="css/style.css" rel="stylesheet" type="text/css" />	
		<link href="css/form.css"rel="stylesheet" type="text/css" />	
  </head>
  <body>


		<div id="main">
			<div id="login">
				<form class="topLabel" method="post" accept-charset="utf-8" action ="../acao/entrar.php" >
					<div class="info">
						<h2>Autenticação</h2>
					</div>
						<?php echo $mensagem ; ?>
					<ul>
						<li>
							<label class="desc" for="login">Usuário ou E-Mail:</label>
							<div>
								<input type="text" name="usuario" class="text meddium" />
							</div>
						</li>
						<li>
							<label class="desc" for="senha">Senha:</label>
							<div>
								<input type="password" name="senha" class="text small" />
							</div>
						</li>
					</ul>
					<div class="buttons">
						<button type="submit" class="button blue large">Entrar</button>
					</div>
				</form>
			</div>

		</div>
  </body>
</html>
