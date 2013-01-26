<?php


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
			<div class = "row" >
				<div class = "span6" >
				<?php if ( !is_null($mensagem) ) :?>
				<div class="alert">
						<?php echo $mensagem ; ?>
				</div>
				<?php endif ; ?>


				<form class="form-horizontal" method="post" accept-charset="utf-8" action ="/seguranca/seguranca/entrar" >
				<fieldset>

							<img src= "/modulos/seguranca/visao/img/logo.png" >
							<div class = "control-group" >
							<label  class = "control-label">E-Mail:</label>
							<div class = "controls" >
							<input type="text" name="email" class="text meddium" />
							</div>			
							</div>

							<div class = "control-group" >
							<label class="control-label" for="senha">Senha:</label>
							<div class = "controls" >
							<input type="password" name="senha" class="text " />
							</div>			
							</div>
	
							<div class = "form-actions" >
							<button type="submit" class="btn btn-large">Entrar</button>
							</div>
							</div>
			</fieldset>	
				</form>
			</div>
			</div>
			</div>

		</div>
  </body>
</html>
