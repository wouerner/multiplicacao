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

        <script>
        $(function() {

          $( ".data" ).datepicker({showWeek:true});
        });

        </script>

        <script>
        $(function() {

          $( ".tempo" ).timepicker();
        });

        </script>

    </head>

    <body>
        <section class = "container-fluid">

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

                    <div class = "row-fluid" >
                        <form method = "post" action = "/relatorio/relatorio/relatorioCelulaEnvio" class = "form-inline"  >
                            <label>Inicio</label>
                            <input type = ""  name = "inicio" class = "data"  >
                            <input type = ""  name = "tempoInicio" class = "tempo" value = "00:00"   >
                            <label>Fim</label>
                            <input type = "" name = "fim" class = "data" >
                            <input type = ""  name = "tempoFim" class = "tempo" value = "00:00"   >
                            <div class = "form-actions" >
                            <button  type = "submit" class = "btn" >Gerar</button>
                            </div>
                        </form>
                    </div>

                        <?php if (isset($relatorios)) :?>
                        <table class = "table table-condensed">

                            <caption><h3>Relatorios </h3></caption>
                                <thead>
                                    <th>Data</th>
                                    <th>Célula</th>
                                    <th>Tema</th>
                                </thead>

                            <?php foreach ( $relatorios as $r ) : ?>

                            <tr class = "<?php echo ($r->titulo) ? '' : 'warning' ; ?>" >
                                <td class = "" >	<?php echo date_format(date_create($r->dataEnvio),'d/m/Y  H:i:s')  ; ?></td>
                                <td><?php echo $r->celulaNome ; ?></td>
                                <td>
                                    <!--<a href = "/celula/relatorio/detalhar/id/<?php echo $r->relatorioId ; ?>" >
                                        <?php echo is_object($r) ? $r->titulo : 'não enviou' ; ?>
                                </td>
                            </tr>

                        <?php endforeach ; ?>
                        </table>
                                        <?php endif ; ?>
            </article>

        </section>

        </section>
    </body>
</html>
