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

                    <?php require 'modulos/celula/visao/chamarCelula.php' ; ?>

            <?php if (isset($mensagem)) : ?>
                    <div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
                      <h4 class="alert-heading">
                        <?php echo $mensagem ?>!
                    </h4>
                   </div>
                <?php endif ; ?>
                        <table class = "table">

                            <caption><h3>Lista de Líderes de Células</h3></caption>
                            <thead>
                                <tr>
                                </tr>
                                <tr>
                                    <th>Nº</th>
                                    <th>Nome</th>
                                </tr>
                            </thead>
                            <?php $total=0?>

                            <?php foreach ( $lideres as $lider) : ?>

                            <tr class="success">
                                <td><?php echo !isset($cont) ? $cont=1 : ++$cont ; ?></td>
                                <td colspan="2">
                                    <a href ="/discipulo/discipulo/detalhar/id/<?php echo $lider->id ?>" ><?php echo $lider->nome ; ?></a>
                                </td>
                                <td>
                                <?php //echo $lider['totalCelulas'] ; ?>
                                </td>
                            </tr>
                            <?php foreach($lider->listarDiscipulos() as $d ):?>
                                <tr class=""><td></td><td><?php echo !isset($c) ? $c=1 : ++$c ; ?> -- <a href ="/discipulo/discipulo/detalhar/id/<?php echo $d->id ?>" ><?php echo $d->nome;?></a></td></tr>
                            <?php endforeach;?>
                            <?php $total += $c?>
                            <?php $c=0 ?>
                        <?php endforeach ; ?>
                            <h3>Lideres: <?php echo count($lideres)?>-
                            Discipulos: <?php echo $total - (2*count($lideres))?></h3>
                        </table>

                        <?php // discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>

            </article>

        </section>

        </section>
    </body>
</html>
