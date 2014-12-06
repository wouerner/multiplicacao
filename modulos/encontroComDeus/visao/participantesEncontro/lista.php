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
                <h3>Quantidade de Encontrista: <?php echo $total?></h3>
                <div class="row-fluid">
                        <table class="table bordered-table">
                        <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Líder</th>
                            <th>Rede</th>
                            <th>Pré?</th>
                            <th>Encontro?</th>
                            <th>Pos?</th>
                            <th>Igreja Local?</th>
                        </thead>
                        <?php foreach ( $discipulos as $d) : ?>
                        <tr class = "<?php echo $d->desistiu==1 ? 'error' : ''; ?>" >
                            <td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
                            <td><?php echo $d->nome ; ?></td>
                            <td><?php echo $d->getLider()->getAlcunha() ; ?></td>

                            <td><?php //var_dump($d->getRede())?><?php echo utf8_encode($d->getRede()['tipoRede']); ?></td>
                        <td>
                            <?php if ($d->preEncontro == 0 ) : ?>
                            <i class = "icon-remove" ></i>
                            <?php else : ?>
                                <i class = "icon-ok" ></i>
                            <?php endif ; ?>
                        </td>
                        <td>
                            <?php if ($d->encontro == 0 ) : ?>
                            <i class = "icon-remove" ></i>
                            <?php else : ?>
                            <i class = "icon-ok" ></i>
                            <?php endif ; ?>
                        </td>
                        <td>
                            <?php if ($d->posEncontro == 0 ) : ?>
                                <i class = "icon-remove" ></i>
                            <?php else : ?>
                                <i class = "icon-ok" ></i>
                            <?php endif ; ?>
                        </td>
                        <td>
                            <?php if ($d->igrejaLocal == 0 ) : ?>
                            <i class = "icon-remove icon-white" ></i>
                            <?php else : ?>
                            <i class = "icon-ok" ></i>
                            <?php endif ; ?>
                        </tr>
                        <?php endforeach ; ?>
                </table>
            </div>
            </div>
            </article>
        </section>
        </section>
    </body>
</html>
