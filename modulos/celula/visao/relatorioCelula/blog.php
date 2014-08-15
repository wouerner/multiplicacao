<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
    </head>
    <body>
        <section class="container-fluid">
            <header>
                <h1 class="text-center">Blog do <?php echo $celula['nome']?></h1>
            </header>
            <section>
                <article>
                    <?php foreach ( $relatorios as $r ) : ?>
                        <table class = "table well">
                            <tr>
                                <td class = "span3" ><h4><?php echo date_format(date_create($r->dataEnvio),'d/m/Y  H:i')  ; ?></h4></td>
                                <td><h4><?php echo $r->titulo ; ?></h4></td>
                            </tr>
                            <tr>
                                <td colspan = "2" ><?php echo $r->texto ; ?></td>
                            </tr>
                        </table>
                    <?php endforeach ; ?>
                </article>
            </section>
        </section>
    </body>
</html>
