<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>

<script>
$(function () {
$('.table').tab('show');
})
</script>

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


        <?php $totalAlcancadosMeta=0 ?>
        <?php $totalAlcacados = 0 ; ?></td>
        <?php $totalRedes = 0; ?>
        <?php foreach($resultado as $k => $metas):  ?>
        <table class = "table table-bordered" >
          <caption><h3>Discipulos com Meta</h3></caption>
                    <thead>
             <th>Rede</th>
             <th>Nome</th>
             <th>Quantidade</th>
             <th>Alcançado</th>
             <th>Ações</th>
          </thead>
          <tbody>
            <?php //var_dump($metas)?>
            <?php $total = count($metas)?>
            <tr><td rowspan="<?php echo $total+1?>" ><?php echo $k?></td></tr>
            <?php  $totalMetas = 0; ?></td>
            <?php foreach ($metas as $m ) : ?>
                <tr>
                    <td><?php echo $m->nome ; ?></td>
                    <td><?php echo $m->quantidade ; ?></td>
                    <td><?php echo $totalAlcacados = $m->getParticipantesMeta()==0 ? 0 :count($m->getParticipantesMeta()); ?></td>
                    <td><a class = "btn btn-danger btn-mini" href = "/metas/metas/excluir/id/<?php echo $m->metaId?>" >Excluir</a></td>
                </tr>
                <?php  $totalMetas += $m->quantidade ; ?></td>
                <?php  $totalAlcacados += $totalAlcacados ; ?></td>
            <?php endforeach ; ?>
            <tr class="info">
                <td></td>
                <td>Total</td>
                <td colspan=""><?php echo $totalMetas ?></td>
                <td colspan="2"><?php echo $totalAlcacados ?></td>
            </tr>
          </tbody>
            <?php $totalRedes +=  $totalMetas ?>
            <?php $totalAlcancadosMeta += $totalAlcacados ?>
            <?php $totalAlcacados=0 ?>
            <?php $totalMetas=0 ?>
          </table>
        <?php endforeach ; ?>
        <table class="table ">
            <thead>
                <th></th>
                <th>Meta</th>
                <th>Alcançado</th>
            </thead>
            <tr>
                <td colspan="">Total das Redes</td>
                <td><?php echo $totalRedes ?></td>
                <td><?php echo $totalAlcancadosMeta ?></td>
            </tr>
          </table>
                <div>
            </article>

        </section>

        </section>
    </body>
</html>
