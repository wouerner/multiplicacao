<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php include 'incluidos/css.inc.php'?>
    <?php include 'incluidos/js.inc.php'?>
</head>
<body>
    <section class="container-fluid">
        <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        <section>
            <article>
                <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
                    <div class = "row-fluid" >
                        <div class = "col-md-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                              <h3 class="panel-title">
                                <a href="/rede/rede/relatorioSemanal/id/<?php echo $tipoRede->id ?>"><?php echo $tipoRede->nome ?></a>
                              </h3>
                              </div>
                                    <table class="well table bordered-table">
                                    <caption>
                                        <h4>
                                        Relatorio Mensal: <?php echo $data . ' até ' . $dataFinal[0]['data'] ?>
                                        <span class="label label-default">Estavel: <?php echo $totalEstavel ?></span>
                                        <span class="label label-success">Adicionados: <?php echo $totalAdicionados ?></span>
                                        <span class="label label-danger">Sairam: <?php echo $totalSairam ?></span>
                                        </h4>
                                    </caption>
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
                                                <?php  $cont=1;  ?>
                                                <?php foreach ( $estavel as $discipulo) : ?>
                                                    <tr >
                                                        <td><?php echo  $cont++  ?></td>
                                                        <td><?php echo $discipulo->funcaoRedeNome ; ?></td>
                                                        <td><?php echo $discipulo->discipuloNome ; ?></td>
                                                        <td><?php echo $discipulo->liderNome ; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <?php  $cont=1;  ?>
                                                <?php foreach ( $adicionados as $discipulo) : ?>
                                                    <tr class="success">
                                                        <td><?php echo  $cont++  ?></td>
                                                        <td><?php echo $discipulo->funcaoRedeNome ; ?></td>
                                                        <td><?php echo $discipulo->discipuloNome ; ?></td>
                                                        <td><?php echo $discipulo->liderNome ; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <?php  $cont=1;  ?>
                                                <?php foreach ( $sairam as $discipulo) : ?>
                                                    <tr class="danger">
                                                        <td><?php echo  $cont++  ?></td>
                                                        <td><?php echo $discipulo->funcaoRedeNome ; ?></td>
                                                        <td><?php echo $discipulo->discipuloNome ; ?></td>
                                                        <td><?php echo $discipulo->liderNome ; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                        </tbody>
                                    </table>

                            </div>

                        </div>
                    </div>
            </article>
        </section>
        </section>
    </body>
</html>
