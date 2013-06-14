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

            <form action = "/discipulo/evento" method = "post" class = "form-horizontal" >
                <fieldset>
                    <legend>Incluir evento</legend>
                    <select name="eventoId">
                        <?php foreach($eventos as $evento) : ?>
                            <option value = "<?php echo $evento['id'] ; ?>" > <?php echo $evento['nome'] ; ?></option>
                        <?php endforeach ; ?>
                    </select>
                    <input name = "discipuloId" type = "hidden" value = "<?php echo $url[3]?>" >

                    <button class = "btn" type = "submit" >Salvar</button>
                </fieldset>
            </form>

                        <table class = "bordered-table">
                        <caption>Eventos</caption>

                        <?php foreach ( $eventosDiscipulos as $evento) : ?>

                        <tr><td colspan = "2" ><a href="/evento/detalhar/id/<?php echo $evento['id']?>" ><?php echo $evento['nome'] ; ?> </a></td></tr>

                            <?php require 'evento/visao/menuEvento.inc.php' ; ?>
                        <?php endforeach ; ?>
                        </table>

                        <?php //discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>

            </article>

        </section>

        </section>
    </body>
</html>
