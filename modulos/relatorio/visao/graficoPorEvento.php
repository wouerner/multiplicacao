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
            <table id = "status" class = "table table-bordered table-condensed" >
            <caption>Escala de Exito  </caption>
                <thead>
                <tr>
                    <td></td>
                    <th scope = "col" >Quantidade</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach($relatorio as $r ) : ?>
                <tr>
                    <th scope = "row" ><?php echo  $r['nomeEvento'] ; ?> </th>
                    <td><?php echo  $r['total'] ; ?></td>
                </tr>

                <?php endforeach ; ?>
                </tbody>
            </table>

            </article>

        </section>

        </section>
    </body>
</html>
