    <!-- div class = "span6" >
        <div>
            <b><i class="icon-gift "></i> <?php echo $totalAniver ; ?> Aniversariantes hoje:</b>
            <?php foreach($discipulosAniver as $da) : ?>
                <?php ++$contator ?>
                <a href = "/discipulo/discipulo/perfil/id/<?php echo $da->id ; ?>" >
                    <?php echo $da->getAlcunha() ; ?>
                </a>
                <?php if ($totalAniver > $contator ) : ?>
                    -
                <?php endif ; ?>
            <?php endforeach ; ?>
        </div>
    </div-->
    <div class="row">
    <div class = "well well-small col-md-4" >

        <section>
            <div id="chart"></div>
            <script>
                var t = jQuery.get('/relatorio/grafico/status')
                        .done(function( data ) {
                            var chart = c3.generate({
                            bindto: '#chart',
                            data: {
                              json: data,
                              type: 'pie',
                            },
                              legend: {position: 'right'}
                            });
                        });

                console.log(teste);
            </script>
        </section>

        <table  class = "table table-striped  tablesorter table-condensed"  >
            <caption><h5>Discipulos</h5></caption>
            <thead>
                <tr>
                    <th></th>
                    <th scope="col">Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalStatus=0 ; ?>
                <?php foreach($status as $s) : ?>
                    <tr>
                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                            <td>
                                <a href="/statusCelular/statusCelular/listarDiscipulosPorStatus/id/<?php echo $s['tipoStatusCelular'] ; ?>" ><?php echo $s['tipoNome'] ; ?>
                                </a></td>
                        <?php else :?>
                            <td><?php echo $s['tipoNome'] ; ?>(<?php echo $s['total'] ; ?>)</td>
                        <?php endif ; ?>
                            <td><?php echo $s['total'] ; ?></td>
                         <!--   <td><?php echo round($s['porcentagem'],1).'%' ; ?></td>-->
                    </tr>
                    <?php $totalStatus += $s['total']?>
                <?php endforeach ; ?>
                <tr  class = "info" >
                    <td>Total</td><td colspan = "2">
                        <?php echo $totalStatus ; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table style="display:none" id="tabelaStatus" class = "table table-striped  tablesorter table-condensed"  >
            <caption><h5>Discipulos</h5></caption>
            <thead>
                <tr>
                    <th></th>
                    <th scope="col1">Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($status as $s) : ?>
                    <tr>
                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                            <th scope="row">
                                <a href="/statusCelular/statusCelular/listarDiscipulosPorStatus/id/<?php echo $s['tipoStatusCelular'] ; ?>" ><?php echo $s['tipoNome'] ; ?>
                                </a></th>
                        <?php else :?>
                            <td><?php echo $s['tipoNome'] ; ?>(<?php echo $s['total'] ; ?>)</td>
                        <?php endif ; ?>
                            <td><?php echo $s['total'] ; ?></td>
                         <!--   <td><?php echo round($s['porcentagem'],1).'%' ; ?></td>-->
                    </tr>
                <?php endforeach ; ?>
                <!-- <tr  class = "info" ><td>Total</td><td colspan = "2">
                <?php echo $totalDiscipulos ; ?>
                    </td> -->
                </tr>
            </tbody>
        </table>
    </div>

    <div class = "well well-small col-md-4" >
        <section>
            <div id="redesChart"></div>
            <script>
                var redes = jQuery.get('/relatorio/grafico/redes')
                        .done(function( data ) {
                            var chart = c3.generate({
                            bindto: '#redesChart',
                            data: {
                              json: data,
                              type: 'pie',
                            },
                              legend: {position: 'right'}
                            });
                        });
            </script>
        </section>
        <table class = "table table-condensed" style="">
            <caption><h5>Redes</h5></caption>
            <thead>
                <th>Nome</th>
                <th>Discipulos</th>
                <th>Celulas</th>
                <th>Metas</th>
            </thead>
            <tbody>
                <?php $total['discipulos']=0?>
                <?php $total['celulas']= 0?>
                <?php $total['metas']= 0?>
                <?php foreach( $tiposRedes as $s) :?>
                <tr>
                    <td>
                        <a href = "/rede/rede/listarMembrosRede/id/<?php echo $s->id ; ?>"><?php echo $s->nome ?></a>
                    </td>
                    <td>
                    <a href = "/rede/rede/listarMembrosRede/id/<?php echo $s->id ; ?>"><?php echo $s->totalDiscipulosPorRede() ?></a>
                    </td>
                    <td>
                        <a href = "/rede/rede/listarCelulas/id/<?php echo $s->id ; ?>"><?php echo $s->listarCelulasTotal() ?></a>
                    </td>
                    <td>
                        <a href = "#"><?php echo $s->getMeta() ?></a>
                    </td>
                </tr>
                <?php $total['discipulos'] += $s->totalDiscipulosPorRede()?>
                <?php $total['celulas']+= $s->listarCelulasTotal()?>
                <?php $total['metas']+= $s->getMeta()?>
                <?php endforeach ; ?>

                <tr class = "info" >
                    <td></td>
                    <td><?php echo $total['discipulos'] ; ?></td>
                    <td><?php echo $total['celulas'] ; ?></td>
                    <td><?php echo $total['metas'] ; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class = "well well-small col-md-4" >
            <div id="ativosChart"></div>
            <script>
                var ativos = jQuery.get('/relatorio/grafico/ativos')
                        .done(function( data ) {
                            var chart = c3.generate({
                            bindto: '#ativosChart',
                            data: {
                              json: data,
                              type: 'pie',
                            },
                              legend: {position: 'right'}
                            });
                        });
            </script>
        <table class="table table-condensed" >
            <caption><h5>Situação</h5></caption>
            <thead>
                <th scope="col">Ativos</th>
                <th scope="col">Inativos</th>
                <th scope="col">Arquivados</th>
                <th scope="col">Total</th>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"><?php echo $totalAtivos['total'] ; ?></td>
                    <td scope="row"><?php echo $totalInativos['total'] ; ?></td>
                    <td scope="row"><?php echo $totalArquivados['total'] ; ?></td>
                    <td><?php echo $totalAtivos['total']+$totalInativos['total']+$totalArquivados['total'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
