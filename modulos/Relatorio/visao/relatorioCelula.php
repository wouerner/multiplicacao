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
                        <form method = "post" action = "/relatorio/relatorio/relatorioCelula" class = "form-inline"  >
                            <label>Inicio</label>
                            <input type = "date"  name = "inicio" class = "data"  >
                            <label>Fim</label>
                            <input type = "date" name = "fim" class = "data" >
                            <div class = "form-actions" >
                            <button  type = "submit" class = "btn" >Gerar</button>
                            </div>
                        </form>
                    </div>

                        <?php if (isset($relatorios)) :?>
                        <table class = "table">

                            <caption><h3>Relatorios </h3></caption>

                            <?php foreach ( $relatorios as $r ) : ?>

                            <tr>
                                <td class = "span3" >
                                    <?php echo date_format(date_create($r->dataEnvio),'d/m/Y  H:i:s')  ; ?></td>
                                <td><h4><a href = "/celula/relatorio/detalhar/id/<?php echo $r->id ; ?>" ><?php echo $r->titulo ; ?></h4></td>
                                <td><?php echo $r->getLider()->nome ; ?></td>
                            </tr>

                        <?php endforeach ; ?>
                        </table>
                                        <?php endif ; ?>
            </article>

        </section>

        </section>
    </body>
</html>
