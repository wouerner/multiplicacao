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

                        <table class = "table">

                            <caption>Relatorios de Celulas</caption>

                            <?php foreach ( $celulas as $celula) : ?>

                            <tr><td ><h4><?php echo $celula['nome'] ; ?> </h4></td>
                                <td>Endereço:<?php echo $celula['endereco'] ; ?>	</td>
                            </tr>

                            <?php endforeach ; ?>
                        </table>

                        <?php // discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>

            </article>

        </section>

        </section>
    </body>
</html>
