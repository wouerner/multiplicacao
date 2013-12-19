<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;

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

        <nav>

            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>

        <header>

        </header>

        <section>
            <article>
            <?php if (isset($mensagem)) : ?>
                    <div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
                      <h4 class="alert-heading">
                        <?php echo $mensagem ?>!
                    </h4>
                   </div>
                <?php endif ; ?>

                        <table class = "table table-condensed">
                        <caption><h3>Lista de Tipos de Admissão</h3></caption>
                        <tr>
                            <th colspan = "2" ><a class = "btn btn-success" href = "/admissao/novoTipoAdmissao" >Novo</a></th>
                        </tr>
                        <tr>
                            <th>Tipo</th><th>Ações</th>
                        </tr>
                        <?php foreach ( $tipoAdmissoes as $tipoAdmissao) : ?>

                        <tr><td><a href="/admissao/detalhar/id/<?php echo $tipoAdmissao['id']?>" ><h:2><?php echo $tipoAdmissao['nome'] ; ?> </h2></a></td>

                            <?php require 'admissao/visao/menuTipoAdmissao.inc.php' ; ?>
                        </tr>
                        <?php endforeach ; ?>
                        </table>

                        <?php //discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>

            </article>

        </section>

        </section>
    </body>
</html>
