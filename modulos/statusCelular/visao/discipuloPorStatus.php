<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
<script>
$(function () {
$('#myTab a:last').tab('show');
})
</script>
    </head>

    <body>
        <section class = "container-fluid">

        <nav>

            <?php include 'menu/visao/menu.inc.php' ; ?>
        </nav>
        <section>
            <article>

                <?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
                <div class = "row-fluid" >

                <div class = "span12" >
<h3>Discipulos em: <?php echo $tipoStatus->nome ?></h3>
    <ul class="nav nav-tabs">
        <li class = "active" ><a href="#ativos" data-toggle="tab">Ativos(<?php echo $totalDiscipulos ; ?>)</a></li>
        <li><a href="#inativos" data-toggle="tab">Inativos(<?php echo $totalInativos ; ?>)</a></li>
    <li><a href="#arquivo" data-toggle="tab">Arquivo(<?php echo $totalArquivo ; ?>)</a></li>
    </ul>

<div class="tab-content">
<div class="tab-pane active" id="ativos">

                <div class = "well" >
                <table class = "table bordered-table">
                <thead>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Líder</th>
                        <th>Sexo</th>
                </thead>
                <?php foreach ( $discipulos as $discipulo) : ?>
                <tr>
                        <td><?php echo !isset($c) ? $c=1 : ++$c  ; ?></td>
                        <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ; ?>" ><strong><?php echo $discipulo->nome ; ?></strong></a></td>
                        <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->getLider()->id ; ?>" ><?php echo $discipulo->getLider()->nome ; ?></a></td>
                        <td><?php echo $discipulo->sexo == 'm' ? 'M' : 'F' ; ?></td>
                </tr>
                </tr>
                <?php endforeach ; ?>
                </table>
                </div>

</div>
<div class="tab-pane" id="inativos">
                <div class = "well" >
                <table class = "table bordered-table">
                <thead>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Líder</th>
                        <th>Sexo</th>
                </thead>
                <?php foreach ( $discipulosInativos as $discipulo) : ?>
                <tr>
                        <td><?php echo !isset($c) ? $c=1 : ++$c  ; ?></td>
                        <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ; ?>" ><strong><?php echo $discipulo->nome ; ?></strong></a></td>
                        <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->getLider()->id ; ?>" ><?php echo $discipulo->getLider()->nome ; ?></a></td>
                        <td><?php echo $discipulo->sexo == 'm' ? 'M' : 'F' ; ?></td>
                </tr>
                </tr>
                <?php endforeach ; ?>
                </table>
                </div>

</div>
<div class="tab-pane" id="arquivo">

                <div class = "well" >
                <table class = "table bordered-table">
                <thead>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Líder</th>
                        <th>Sexo</th>
                </thead>
                <?php foreach ( $discipulosArquivo as $discipulo) : ?>
                <tr>
                        <td><?php echo !isset($c) ? $c=1 : ++$c  ; ?></td>
                        <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ; ?>" ><strong><?php echo $discipulo->nome ; ?></strong></a></td>
                        <td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->getLider()->id ; ?>" ><?php echo $discipulo->getLider()->nome ; ?></a></td>
                        <td><?php echo $discipulo->sexo == 'm' ? 'M' : 'F' ; ?></td>
                </tr>
                </tr>
                <?php endforeach ; ?>
                </table>
                </div>

</div>
<div class="tab-pane" id="settings">...</div>
</div>
                </div>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
