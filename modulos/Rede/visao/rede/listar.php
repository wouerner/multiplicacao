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
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#ativos" aria-controls="ativos" role="tab" data-toggle="tab">Ativos</a></li>
                        <li role="presentation"><a href="#inativos" aria-controls="inativos" role="tab" data-toggle="tab">Inativos</a></li>
                        <li role="presentation"><a href="#arquivo" aria-controls="arquivo" role="tab" data-toggle="tab">Arquivo</a></li>
                        <li role="presentation"><a href="/rede/rede/relatorioSemanal/id/<?php echo $tipoRede->id ; ?>" class="btn">Resumo</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="ativos">
                            <table class = " table bordered-table table-condensed">
                                <caption><h3>Ativos rede <?php echo $tipoRede->nome ; ?></h3></caption>
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nome</th>
                                        <th>Função</th>
                                        <th>Líder</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $funcoes as $funcao) : ?>
                                        <?php foreach ( $redeMembros as $discipulo) : ?>
                                            <?php if ( $funcao['id'] == $discipulo->getFuncaoRede()->id) : ?>
                                                <tr>
                                                    <td><?php echo  $cont++  ?></td>
                                                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                                    <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ?>" ><?php echo $discipulo->nome ; ?></a></td>
                                                        <td><?php echo $discipulo->getFuncaoRede()->nome; ?></td>
                                                    <td><a href="/discipulo/discipulo/detalhar/id/<?php echo is_object($lider=$discipulo->getLider()) ? $lider->id : '' ; ?>"><?php echo $lider->nome ; ?></a></td>

                                                    <?php else : ?>
                                                        <td><?php echo $discipulo->nome ; ?></td>
                                                        <td><?php echo $discipulo->getFuncaoRede()->nome; ?></td>
                                                        <td><?php echo is_object($lider=$discipulo->getLider()) ? $lider->nome : '' ; ?></td>
                                                    <?php endif ; ?>
                                                    <?php if ($acesso->hasPermission('admin_acesso') == true || $liderRede): ?>
                                                        <td><a target="blank" class="btn-xs btn btn-mini btn-danger" href="/discipulo/discipulo/arquivar/id/<?php echo $discipulo->id?>"> Arquivar</a></td>
                                                    <?php endif?>
                                                </tr>
                                            <?php endif?>
                                        <?php endforeach ; ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                       <td colspan = "" >Total</td>
                                       <td colspan = "" ><?php echo $metaTotal?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="inativos">
                            <?php $cont=1  ?>
                            <table class = "table bordered-table">
                                <caption><h3>Inativos rede: <?php echo $tipoRede->nome ; ?></h3></caption>
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nome</th>
                                        <th>Função</th>
                                        <th>Líder</th>
                                        <th>OBS</th>
                                        <th>Meta </th>
                                        <th>Ações </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $redeInativos as $discipulo) : ?>
                                        <?php if ($discipulo->ativo==0): ?>
                                            <tr>
                                                <td><?php echo  $cont++  ?></td>
                                                    <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                                    <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ?>" ><?php echo $discipulo->nome ; ?></a></td>
                                                <td><?php echo $discipulo->getFuncaoRede()->nome; ?></td>
                                                    <td><a href="/discipulo/discipulo/detalhar/id/<?php echo is_object($lider=$discipulo->getLider()) ? $lider->id : '' ; ?>"><?php echo $lider->nome ; ?></a></td>
                                                    <td><?php echo $discipulo->observacao; ?></td>
                                                    <td><?php echo is_object($meta = $discipulo->getMeta()) ? $meta->quantidade : 0 ?></td>
                                                    <?php $metaTotal+= is_object($meta) ? $meta->quantidade : 0?>
                                                <?php else : ?>
                                                    <td><?php echo $discipulo->nome ; ?></td>
                                                <td><?php echo $discipulo->getFuncaoRede()->nome; ?></td>
                                                    <td><?php echo is_object($lider=$discipulo->getLider()) ? $lider->nome : '' ; ?></td>
                                                    <td><?php echo $discipulo->observacao; ?></td>
                                                    <td><?php echo is_object($meta = $discipulo->getMeta()) ? $meta->quantidade : 0 ?></td> <?php $metaTotal+= is_object($meta)? $meta->quantidade : 0 ?>
                                                <?php endif ; ?>
                                                <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                                    <td><a target="blank" class="btn btn-mini btn-inverse" href="/discipulo/discipulo/arquivar/id/<?php echo $discipulo->id?>"> Arquivar</a></td>
                                                <?php endif?>
                                            </tr>
                                        <?php endif?>
                                    <?php endforeach ; ?>
                                </tbody>
                                <tfoot>
                                   <td colspan = "" >Total</td>
                                   <td colspan = "" ><?php echo $metaTotal?></td>
                                </tfoot>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="arquivo">
                            <?php $cont=1  ?>
                            <table class = "table bordered-table">
                                <caption><h3>Arquivo rede: <?php echo $tipoRede->nome ; ?></h3></caption>
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nome</th>
                                        <th>Função</th>
                                        <th>Líder</th>
                                        <th>OBS</th>
                                        <th>Meta </th>
                                        <th>Ações </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $redeArquivados as $discipulo) : ?>
                                        <?php if ($discipulo->ativo==0): ?>
                                            <tr>
                                                <td><?php echo  $cont++  ?></td>
                                                    <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                                    <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ?>" ><?php echo $discipulo->nome ; ?></a></td>
                                                <td><?php echo $discipulo->getFuncaoRede()->nome; ?></td>
                                                    <td><a href="/discipulo/discipulo/detalhar/id/<?php echo is_object($lider=$discipulo->getLider()) ? $lider->id : '' ; ?>"><?php echo $lider->nome ; ?></a></td>
                                                    <td><?php echo $discipulo->observacao; ?></td>
                                                    <td><?php echo is_object($meta = $discipulo->getMeta()) ? $meta->quantidade : 0 ?></td>
                                                    <?php $metaTotal+= is_object($meta) ? $meta->quantidade : 0?>
                                                <?php else : ?>
                                                    <td><?php echo is_object($lider=$discipulo->getLider()) ? $lider->nome : '' ; ?></td>
                                                <td><?php echo $discipulo->getFuncaoRede()->nome; ?></td>
                                                    <td><?php echo $discipulo->observacao; ?></td>
                                                    <td><?php echo $discipulo->nome ; ?></td>
                                                    <td><?php echo is_object($meta = $discipulo->getMeta()) ? $meta->quantidade : 0 ?></td> <?php $metaTotal+= is_object($meta)? $meta->quantidade : 0 ?>
                                                <?php endif ; ?>
                                            </tr>
                                        <?php endif?>
                                    <?php endforeach ; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan = "" >Total</td>
                                        <td colspan = "" ><?php echo $metaTotal?></td>
                                    </tr>
                                </tfoot>
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
