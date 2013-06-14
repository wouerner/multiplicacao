<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
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

                <form action="" method="post" >
          <label>Celulas:</label>
          <select class = "span4"  name = "temaId"  required>
             <?php foreach( $celulas as $t) : ?>
                         <option value= "<?php echo $t->id ?>" ><?php echo $t->nome ?></option>
             <?php endforeach; ?>
                    </select>
          <button type = "submit" class = "btn" >Gerar</button>
                </form>

                            <caption><h3>Relatorios de Célula</h3></caption>

                            <?php foreach ( $relatorios as $r ) : ?>
                        <table class = "table table-bordered">
               <thead>
              </thead>
                                            <tr class = "">
                                                <td class = "" ><?php echo $r->getLider()->nome  ; ?></td>
                                                <td class = "" ><?php echo $r->titulo  ; ?></td>
                                            </tr>
                                            <tr class = "">
                                                <td colspan = "2" class = "" ><?php echo $r->texto  ; ?></td>
                                            </tr>
                     </table>
                         <?php endforeach ; ?>
            </article>
        </section>
    </body>
</html>
