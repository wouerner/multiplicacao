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
            <table class = "table table-bordered table-condensed" >

                <?php $cont = 0 ; ?>
                <?php $lidCont = 0 ; ?>

                <?php foreach($relatorio as  $r ) : ?>

                <?php ++$lidCont ; ?>
                <tr><td colspan = "5" > <strong><?php echo $lidCont ; ?> - Lider: <?php echo $r['lider']?>	</strong></td></tr>

                        <?php foreach($r as  $l ) : ?>
                            <tr>
                                <?php if (  is_object($l) ) : ?>
                                <td><?php echo ++$cont ; ?></td>
                                <td><?php echo  $l->nomeDiscipulo ; ?></td>
                                <td><?php echo  $l->endereco ; ?></td>
                                <td><?php echo  $l->telefone ; ?></td>
                                <td><?php echo  $l->getDataNascimento()->format('d/m/y') ; ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach ; ?>

                    <?php $cont = 0 ?>
                <?php endforeach ; ?>
            </table>
            </article>

        </section>

        </section>
    </body>
</html>
