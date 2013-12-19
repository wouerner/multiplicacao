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
          <label>Temas:</label>
          <select class = "span4" size = "5" name = "temasId[]" multiple required>
             <?php foreach( $temas as $t) : ?>
                         <option value= "<?php echo $t->id ?>" ><?php echo $t->nome ?></option>
             <?php endforeach; ?>
                    </select>
          <button type = "submit" class = "btn" >Gerar</button>
                </form>

                            <caption><h3>Relatorios de Célula</h3></caption>

                        <table class = "table ">
               <thead>
                                <th>Célula</th>
                            <?php foreach ( $tem as $r ) : ?>
                                <th><?php echo $r->nome; ?></th>
                            <?php endforeach; ?>
              </thead>

                            <?php foreach ( $rel as $r => $re) : ?>
                                            <tr class = "">
                                                <td class = "" ><?php echo $r  ; ?></td>
                               <?php foreach ( $ids as $k => $v ) : ?>
                                                <td class = "" >
                           <?php //echo $v; ?>
                           <?php //var_dump($re); ?>
                           <?php echo array_key_exists($v, $re)? '<span class = "label label-success" >sim</span> ': '<span class = "label label-important" >não</span>' ; ?>

                        </td>
                             <?php endforeach ; ?>
                                            </tr>
                          <?php endforeach ; ?>

                <!--			<?php foreach ( $relatorios as $r ) : ?>

                            <tr class = "<?php echo $r['temaNome']=='sem'? 'error': ''?>">
                                <td class = "" ><?php echo $r['celulaNome']  ; ?></td>
                                <td class = "" ><?php echo $r['temaNome']  ; ?></td>
                            </tr>
                        <?php endforeach ; ?>
-->
                        </table>
            </article>
        </section>
    </body>
</html>
