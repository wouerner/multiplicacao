<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style type="text/css">
           @import url("../../../ext/twitter-bootstrap/bootstrap.css");
           @import url("../../../ext/jQuery-Visualize/css/visualize.css");
           @import url("../../../incluidos/css/estilo.css");
        </style>
        <script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
        <script src="../../../ext/jQuery-Visualize/js/visualize.jQuery.js"></script>
        <script>
$(function(){
            $('.table').visualize({type: 'pie',pieMargin: 40,pieLabelPos:'outside',   height: '300px', width: '900px'});
});
        </script>
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

<div class = "row" >
    <div class = "span12" >
        <form method="post" class = " form-inline" >
                <fieldset>
                        <legend>Grafico por Célula</legend>

                            <label>Celula:</label>
                                <select class = "span2" name = "celula" >
                                <?php foreach ( $celulas as $c) : ?>
                                    <option value = "<?php echo $c['id'] ;?>" ><?php echo $c['nome']?></option>
                                    <?php endforeach ; ?>

                            </select>

                        <button class = "btn" type="submit">Gerar</button>
                </fieldset>
        </form>

    <?php if ( isset($relatorio) ) : ?>
            <table id = "status" class = "table table-bordered table-condensed" >
                <caption><h3>Quandidade Por Status <?php echo $nomeCelula['nome'] ?></h3></caption>
                <thead>
                <tr>
                    <td></td>
                    <th scope = "col" >Quantidade</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($relatorio as $r ) : ?>
                <tr>
                    <th scope = "row" ><?php echo  $r['nome'] ; ?> </th>
                    <td><?php echo  $r['total'] ; ?></td>
                </tr>

                <?php endforeach ; ?>
                </tbody>
            </table>

            <?php endif ; ?>
                        <?php // discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
    </div>
    </div>
            </article>

        </section>

        </section>
    </body>
</html>
