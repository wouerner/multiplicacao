<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>

    <body>
        <section class = "container-fluid">

        <nav>

            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>

        <section>
            <article>

                <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
                <div class = "row-fluid" >
                        <table class = "table bordered-table">
                        <caption><h3>Pre Equipe (<?php echo $total?>)</h3></caption>
                        <thead>
                        <th>Nome</th>
                        <th>Ações</th>
                        </thead>

                        <?php foreach ( $discipulos as $e) : ?>
                        <tr>
                            <td><?php echo $e->nome ; ?></td>
                            <td><a class = "btn btn-mini btn-success" href="/encontroComDeus/equipe/novoMembro/id/<?php echo $e->id?>"><i class = "icon-plus icon-white" ></i> Cadastrar em um equipe</a>
                            <a class = "btn btn-mini btn-danger" href="/encontroComDeus/preEquipe/excluirMembro/id/<?php echo $e->id?>"><i class = "icon-plus icon-white" ></i> Excluir</a></td>
                        </tr>
                        <?php endforeach ; ?>
                        </table>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
