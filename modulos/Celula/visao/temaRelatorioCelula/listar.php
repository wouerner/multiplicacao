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

                    <?php require 'modulos/Celula/visao/chamarCelula.php' ; ?>

            <?php if (isset($mensagem)) : ?>
                    <div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
                      <h4 class="alert-heading">
                        <?php echo $mensagem ?>!
                    </h4>
                   </div>
                <?php endif ; ?>
                        <table class = "table well table-striped ">

                            <caption><h3>Tema Relatório de Célula</h3></caption>

                            <thead>
                                <th>Nome</th>
                                <th>Data Inicio</th>
                                <th>Data Fim</th>
                                <th>Ações</th>
                            </thead>

                            <?php foreach ( $temas as $t) : ?>

                            <tr>
                                <td><?php echo $t->nome ; ?></td>
                                <td><?php echo $t->dataInicio ; ?>	</td>
                                <td><?php echo $t->dataFim ; ?></td>
                                <td>
                                    <?php if ($t->ativo == 1 ) : ?>
                                    <a class = "btn btn-mini btn-warning" href = "/celula/temaRelatorioCelula/desativar/id/<?php echo $t->id ; ?>" ><i class = "icon-arrow-down" ></i></a>
                                    <?php else : ?>
                                    <a class = "btn btn-mini btn-success" href = "/celula/temaRelatorioCelula/ativar/id/<?php echo $t->id ; ?>" ><i class = "icon-arrow-up" ></i></a>
                                    <?php endif ; ?>
                                    <a class = "btn btn-mini btn-danger" href = "/celula/temaRelatorioCelula/excluir/id/<?php echo $t->id ; ?>" ><i class = "icon-remove" ></i></a>
                                </td>
                            </tr>

                        <?php endforeach ; ?>
                        </table>

            </article>

        </section>

        </section>
    </body>
</html>
