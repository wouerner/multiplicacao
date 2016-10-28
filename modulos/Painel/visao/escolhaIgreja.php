<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>

        <script src="../modulos/discipulo/visao/js/novo.js"></script>
        <script src = "/modulos/discipulo/visao/js/pesquisa.js" ></script>
        <script>
            $(document).ready(function() {
            $("table").tablesorter();
            }
                );
        </script>

        <style type="text/css">
           @import url("../../../ext/jQuery-Visualize/css/visualize.css");
        </style>
        <script src="../../../ext/jQuery-Visualize/js/visualize.jQuery.js"></script>
        <script>
$(function(){
            //$('#tabelaStatus').visualize({type: 'pie',pieMargin: 75,
                                          //pieLabelPos:'inside',
                                          //height: '363px', width: '400px'});
            $('#discipulosEstado').visualize({type: 'pie',pieMargin: 30,
                                          pieLabelPos:'inside',
                                          height: '455px', width: '400px'});
            $('#discipulosRede').visualize({type: 'pie',pieMargin: 40,
                                          pieLabelPos:'inside',
                                          height: '300px', width: '400px'});
});
        </script>
    </head>
    <body>
        <section class = "container-fluid">
             <div class="row">
            <?php foreach($igrejas as $igreja):?>
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="/modulos/Painel/visao/logo_<?php echo $igreja->sigla?>.png" alt="...">
                  <div class="caption">
                    <h3><?php echo $igreja->nome?></h3>
                    <p><a href="/painel/painel/igreja/igreja/<?php echo $igreja->id?>" class="btn btn-primary" role="button">Acessar</a> </p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
            </div>
        </section>
    </body>
</html>
