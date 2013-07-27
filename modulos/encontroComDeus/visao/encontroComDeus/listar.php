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

                <?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>

                <div class = "row-fluid" >
                        <table class = "table bordered-table">
                        <caption><h3>Encontro </h3></caption>
                        <thead>
                            <th>Nome</th>
                            <th>Ações</th>
                        </thead>

                        <?php foreach ( $encontros as $e) : ?>
                        <tr>
                            <td><?php echo $e->nome ; ?></td>
                            <td>
                                <a class = "btn btn-mini" href="/encontroComDeus/participantesEncontro/index/id/<?php echo $e->id?>">
                                    <i class = "icon-user "></i>Participantes
                                </a>
                            <a class = "btn btn-mini"  href="/encontroComDeus/preEquipe/index/id/<?php echo $e->id?>"><i class = "icon-wrench" ></i>Pre-Equipes</a>
                            <a class = "btn btn-mini"  href="/encontroComDeus/equipe/index/id/<?php echo $e->id?>"><i class = "icon-wrench" ></i>Equipes</a>
                            <a class = "btn btn-mini"  href="/encontroComDeus/participantesEncontro/cracha/id/<?php echo $e->id?>"><i class = "icon-barcode" ></i> Cracha</a>
                            <a class = "btn btn-mini"  href="/encontroComDeus/participantesEncontro/ficha/id/<?php echo $e->id?>"><i class = "icon-file" ></i> Ficha</a>
                                <a class = "btn btn-mini btn-danger" href="/encontroComDeus/encontroComDeus/excluir/id/<?php echo $e->id?>">
                                    <i class = "icon-remove icon-white" ></i> Excluir
                                </a>
              <?php if ( !$e->ativo): ?>
                                <a class = "btn btn-mini " href="/encontroComDeus/encontroComDeus/ativar/id/<?php echo $e->id?>">
                                    <i class = "icon-arrow-up icon-white" ></i> Ativar
                                </a>
              <?php else: ?>
                                </a>
                                <a class = "btn btn-mini " href="/encontroComDeus/encontroComDeus/desativar/id/<?php echo $e->id?>">
                                    <i class = "icon-arrow-down icon-white" ></i> Desativar
                                </a>
              <?php endif ; ?>
                            </td>
                        </tr>

                        <?php endforeach ; ?>
                        </table>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
