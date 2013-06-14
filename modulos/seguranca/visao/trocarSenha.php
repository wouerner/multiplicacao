<?php

$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL;
$erros =  isset($_SESSION['erros']) ? $_SESSION['erros'] : NULL;

unset($_SESSION['mensagem']);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    <title>Autenticação</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  </head>
  <body>

        <div class = "container-fluid">
            <div class = "row-fluid" >
                <?php if ( !is_null($mensagem) ) :?>
                <div class="alert">
                        <?php echo $mensagem ; ?>
                </div>
                <?php endif ; ?>

<?php include 'modulos/menu/visao/menu.inc.php' ; ?>
                <?php echo isset($mens) ? $mens :'' ; ?>
                <div class = "well" >
                <h3>Trocar Senha</h3>
                <form class="form-horizontal" method="post" accept-charset="utf-8" action ="/seguranca/seguranca/trocarSenha" >
                <fieldset>

                            <div class = "control-group" >
                                <label  class = "control-label">E-Mail:</label>
                                <div class = "controls" >
                                    <input type="text" name="email" class="text meddium" value = "<?php echo $discipulo->email ; ?>" disabled />
                                    <input type="hidden" name="email" class="text meddium" value = "<?php echo $discipulo->email ; ?>"  />
                                </div>
                            </div>

                            <div class = "control-group" >
                                <label class="control-label" for="senha">Senha:</label>
                                <div class = "controls" >
                                    <input type="password" name="senha" class="text " />
                                </div>
                            </div>

                            <div class = "form-actions" >
                            <button type="submit" class="btn btn-large">Trocar</button>

                            </div>
                            </div>
            </fieldset>
                </form>
            </div>
            </div>
            </div>
            </div>

        </div>
  </body>
</html>
