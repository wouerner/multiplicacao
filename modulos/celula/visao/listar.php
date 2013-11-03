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
        <section class = "container-fluid">

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

            <table class = "table well table-striped ">
                <caption><h3>Lista de Células Ativos: <?php echo  $totalCelulas ; ?></h3></caption>
            </table>

                    <table class="well table" >
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Horário</th>
                        <th>Ações</th>
                    </tr>
                    <?php //$celulas =null?>
                    <?php foreach ( $celulas as $celula) : ?>
                    <?php  $rede =$celula->pegaRede() ?>
                    <tr>
                        <td><?php echo !isset($cont) ? $cont=1 : ++$cont ; ?></td>
                        <td>
                            <a href ="#" >
                                <?php   echo is_object($rede) ? $rede->nome : '' ; ?>  </td>
                        <td><a href ="/celula/celula/detalhar/id/<?php echo $celula->id ; ?>" ><?php echo $celula->nome ; ?></td>
                        <td><?php echo $celula->endereco ; ?>	</td>
                        <td><?php echo $celula->horarioFuncionamento ; ?></td>
                        <?php require 'celula/visao/menuCelula.inc.php' ; ?>
                    </tr>
                <?php endforeach ; ?>
            </table>

            <table class = "table well table-striped ">
                <caption><h3>Lista de Células Inativas: <?php echo  count($celulasInativas) ; ?></h3></caption>
            </table>

                    <table class="well table" >
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Horário</th>
                        <th>Ações</th>
                    </tr>
                    <?php //$celulas =null?>
                    <?php foreach ( $celulasInativas as $celula) : ?>
                    <?php  $rede =$celula->pegaRede() ?>
                    <tr>
                        <td><?php echo !isset($cont) ? $cont=1 : ++$cont ; ?></td>
                        <td>
                            <a href ="#" >
                                <?php   echo is_object($rede) ? $rede->nome : '' ; ?>  </td>
                        <td><a href ="/celula/celula/detalhar/id/<?php echo $celula->id ; ?>" ><?php echo $celula->nome ; ?></td>
                        <td><?php echo $celula->endereco ; ?>	</td>
                        <td><?php echo $celula->horarioFuncionamento ; ?></td>
                        <?php require 'celula/visao/menuCelula.inc.php' ; ?>
                    </tr>
                <?php endforeach ; ?>
                </table>

            </article>

        </section>

        </section>
    </body>
</html>
