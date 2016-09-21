<?php
$mensagem = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : NULL ;
unset($_SESSION['mensagem']) ;

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>

    <body>
        <section class = "container">

        <nav>

            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>

        <section>
            <article>

                <?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>

            <?php if (isset($mensagem)) : ?>
                    <div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
                      <h4 class="alert-heading">
                        <?php echo $mensagem ?>!
                    </h4>
                   </div>
                <?php endif ; ?>

                <div class = "row" >
                    <div class = "span12" >
                        <table class = "table bordered-table">
                        <caption><h3>Lista de Tipo Estado Civil</h3></caption>
                        <thead>
                            <tr><th>
                                <a class = "btn btn-success" href = "/discipulo/novoEstadoCivil"><i class = "icon-plus icon-white" ></i> Novo</a>
                            </th></tr>
                            <tr>
                            <th>
                                Nome
                            </th>
                            <th>
                                Ações
                            </th>
                            </tr>
                        </thead>

                        <?php foreach ( $estadosCivies as $estadoCivil) : ?>

                        <tr><td><a href = "/discipulo/atualizarEstadoCivil/id/<?php echo $estadoCivil['id']?>"><?php echo $estadoCivil['nome'] ; ?></a></td>
                                <td><a class = "btn btn-primary" href = "/discipulo/atualizarEstadoCivil/id/<?php echo $estadoCivil['id']?>" ><i class = "icon-pencil icon-white" ></i></a>
                                        <a class = "btn btn-danger" href = "/discipulo/excluirEstadoCivil/id/<?php echo $estadoCivil['id']?>" ><i class = "icon-remove icon-white" ></i></a>
                                </td>

                        </tr>

                        <?php endforeach ; ?>
                        </table>
                    <div class = "form-actions" >
                        <?php //discipulo\Modelo\Discipulo::mostrarPaginacao( $totalDiscipulos['total'] ,3 ,$pagina ) ; ?>
                    </div>
                </div>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
