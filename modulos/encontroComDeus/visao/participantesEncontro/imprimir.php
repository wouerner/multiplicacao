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

    <body style="background: none">
        <section class = "container-fluid">
        <section>
            <article>
                <h3>Quantidade de Encontrista: <?php echo $total?></h3>
                <div class = "row-fluid" >
                        <table class = "table bordered-table">
                            <caption><h3>Homens</h3></caption>
                            <thead>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Líder</th>
                            </thead>
                    <?php foreach ( $discipulos as $d) : ?>
                        <?php if ($d->sexo == 'm') :?>
                                <tr class = "" >
                                    <td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
                                    <td><?php echo $d->nome ; ?></td>
                                    <td><?php echo $d->getLider()->getAlcunha() ; ?></td>
                            </tr>
                            <?php endif?>
                        <?php endforeach ; ?>
                        </table>
                        <table class = "table bordered-table">
                            <caption><h3>Mulheres</h3></caption>
                            <thead>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Líder</th>
                            </thead>
                            <?php foreach ( $discipulos as $d) : ?>
                                <?php if ($d->sexo == 'f') :?>
                                <tr class = "" >
                                    <td><?php echo !isset($a) ? $a=1 : ++$a ; ?></td>
                                    <td><?php echo $d->nome ; ?></td>
                                    <td><?php echo $d->getLider()->getAlcunha() ; ?></td>
                            </tr>
                            <?php endif?>
                        <?php endforeach ; ?>
                        </table>
                </div>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
