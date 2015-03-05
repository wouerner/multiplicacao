<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>

    <body>
        <section class="container">
        <nav>
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>
        <section>
        <h3><?php echo $encontro->nome?></h3>
            <div id="ativosChart"></div>
            <script>
                    var ativos = jQuery.get('/relatorio/grafico/encontro/id/<?php echo $encontro->id?>')
                        .done(function( data ) {
                            var chart = c3.generate({
                            bindto: '#ativosChart',
                            data: {
                              json: data,
                              type: 'pie',
                            },
                              legend: {position: 'right'}
                            });
                        });
            </script>
        </section>
    </body>
</html>
