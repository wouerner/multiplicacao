<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL;
$dados = isset($_SESSION['dados']) ? $_SESSION['dados'] : NULL;
$_SESSION['mensagem'] = isset($_SESSION['mensagem']) ? NULL : NULL;
$_SESSION['dados'] = isset($_SESSION['dados']) ? NULL : NULL;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <?php include 'incluidos/css.inc.php'?>
    <?php include 'incluidos/js.inc.php'?>
</head>
<body>
    <section class="container-fluid">
        <header>
            <nav>
                <?php require 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
        </header>
        <section>
            <article>
                <?php if ($mensagem) : ?>
                    <div class = "<?php echo $mensagem['class']?>" >
                        <?php echo $mensagem['mensagem'] ; ?>
                    </div>
                <?php endif ; ?>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Novo Cadastro</h3>
                  </div>
                  <div class="panel-body">
                        <?php include 'modulos/Discipulo/visao/formularioNovoCompleto.inc.php' ; ?>
                  </div>
                </div>
            </article>
        </section>
    </section>
</body>
</html>
