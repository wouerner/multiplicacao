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

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1&appId=224511560936102";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

        <div class = "container-fluid">
            <div class = "row-fluid" >

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
            </fieldset>
                </form>

            </div>
<div class = "span6" >
    <div class="fb-like-box" data-href="http://www.facebook.com/pages/Multiplica%C3%A7%C3%A3o-12/421256084635856" data-width="292" data-height="360" data-show-faces="true" data-stream="true" data-header="true"></div>
</div>

            </div>
  </body>
</html>
