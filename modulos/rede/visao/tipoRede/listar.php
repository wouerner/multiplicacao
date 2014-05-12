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
        <section>
            <style>
                #chart {
                    width: 100% !important;
                    /*max-width: 800px;*/
                    height: auto !important;
                }
            </style>
            <div class="row-fluid">
                <h1>Redes</h1>
                <?php foreach ( $redes as $rede) : ?>
                <?php $crescimento = $rede->crescimento('2014-04-15',date('Y-m-d'))?>
                <?php //var_dump($rede->crescimento('2014-04-15',date('2014-04-16')))?>
                <div class = "span5 well" >
                    <script type="text/javascript" src="/incluidos/js/rede.js"></script>
                        <h2>
                            <a href="/rede/rede/detalharTipoRede/id/<?php echo $rede->id?>" >
                                <?php echo $rede->nome ; ?>
                            </a>
                        </h2>
                        <canvas id="chart<?php echo $rede->id?>" width="500"  height="300"></canvas>
                        <span class="label label-info"><?php echo $rede->totalDiscipulosPorRede() ; ?></span>
                        <a href="/rede/rede/listarMembrosRede/id/<?php echo $rede->id ; ?>" class = "btn btn-mini " ><i class = "icon-list" ></i> listar Discipulos </a>
                        <a href="/rede/rede/listarCelulas/id/<?php echo $rede->id ; ?>" class = "btn btn-mini " ><i class = "icon-list" ></i> listar Células</a>
                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                            <a href="/rede/rede/atualizarTipoRede/id/<?php echo $rede->id ; ?>" class = "btn btn-mini btn-primary" ><i class="icon-edit icon-white"></i> Atualizar</a>
                            <a href="/rede/rede/excluirTipoRede/id/<?php echo $rede->id ; ?>" class = "btn btn-mini btn-danger" ><i class = "icon-remove icon-white" ></i> excluir</a>
                        <?php endif ; ?>
                        <script>
                            var data = {
                                labels : [
                                            <?php echo '"'.implode('","',array_keys($crescimento)).'"'?>
                                        ],
                                datasets : [
                                    {
                                    fillColor : "rgba(250,0,0,0.5)",
                                    strokeColor : "rgba(220,0,0,1)",
                                    pointColor : "rgba(220,220,220,1)",
                                    pointStrokeColor : "#fff",
                                        data : [
                                            <?php echo implode(',',array_values($crescimento))?>
                                            ]
                                    },
                                ]
                            }
                            var ctx = $("#chart<?php echo $rede->id?>").get(0).getContext("2d");
                            //var ctx = document.getElementById("#chart<?php echo $rede->id?>").getContext("2d");
                            console.log(ctx);
                            var myNewChart = new Chart(ctx).Line(data,defaults);
                        </script>
                </div>
                <?php endforeach ; ?>
            </div>
        </section>
        <section>
            <article>
                <?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
                <div class = "row-fluid" >
                <div class = "span12" >
                        <table class = "well table table-condensed">
                        <caption>
                            <h3>Lista de Tipo de Rede</h3>
                        </caption>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Total Discipulos</th>
                            <th>Metas</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ( $redes as $rede) : ?>

                        <tr>
                            <td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
                            <td><a href="/rede/rede/detalharTipoRede/id/<?php echo $rede->id?>" >
                                <?php echo $rede->nome ; ?> </a></td>
                            <td><?php echo $rede->totalDiscipulosPorRede() ; ?> </td>
                            <td><?php echo $rede->getMeta() ; ?> </td>
                            <?php $totalMeta += $rede->getMeta() ; ?>
                            <?php $totalDisc += $rede->totalDiscipulosPorRede() ; ?>
                            <?php require 'rede/visao/tipoRede/menu.inc.php' ; ?>
                        </tr>

                        <?php endforeach ; ?>
                        <tr><td colspan= "2">Total</td><td><?php echo $totalDisc ?></td><td colspan=""><?php echo $totalMeta ?></td></tr>
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
