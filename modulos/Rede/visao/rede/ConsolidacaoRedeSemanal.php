<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php include 'incluidos/css.inc.php'?>
    <?php include 'incluidos/js.inc.php'?>
</head>
<body>
    <section class = "container-fluid">
        <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        <section>
            <article>
                <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
        <div class = "row-fluid" >
            <div class = "col-md-12">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="ativos">
                            <table class = "well table bordered-table">
                                <caption><h3><a href="/rede/rede/listarMembrosRede/id/<?php echo $tipoRede->id ?>"><?php echo $tipoRede->nome ?></a>: Resumo Mensal</h3></caption>
                                <tbody>
                                    <?php foreach ( $resumoRede as $resumo) : ?>
                                        <tr>
                                            <td><?php echo  $resumo->tipoNome;  ?></td>
                                            <td><?php echo $resumo->total; ?></td>
                                            <td>
                                                <a class="btn btn-default" href="/rede/rede/compararRelatorio/id/<?php echo $resumo->tipoRedeId ?>/data/<?php echo $resumo->data; ?>" >
                                                    <i class="icon-bar-chart"></i>
                                                    <?php $date = new DateTime($resumo->data) ; echo $date->format('d-m-Y'); ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php foreach ( $redeMembros as $k => $data) : ?>
                            <table class = "well table bordered-table">
                                <caption><h3>Relatorio Semanal: <?php echo  $k; ?></h3></caption>
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Função</th>
                                        <th>Nome</th>
                                        <th>Lider</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php  $cont=0;  ?>
                                        <?php foreach ( $data as $discipulo) : ?>
                                            <tr>
                                                <td><?php echo  $cont++  ?></td>
                                                <td><?php echo $discipulo->funcaoRedeNome ; ?></td>
                                                <td><?php echo $discipulo->discipuloNome ; ?></td>
                                                <td><?php echo $discipulo->liderNome ; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </article>
        </section>
        </section>
    </body>
</html>
