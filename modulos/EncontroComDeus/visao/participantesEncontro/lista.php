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
             <div>

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Geral</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Homens X Mulheres</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Redes</a></li>
              </ul>
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
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
                                    <td><?php echo $d->getLider() ? $d->getLider()->getAlcunha() : null ; ?></td>

                                    <td><?php echo $d->getRede() ? utf8_encode($d->getRede()[0]['tipoRede']) : null; ?></td>
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
                <div role="tabpanel" class="tab-pane" id="profile">
                    <table class="table bordered-table">
                        <caption>Homens</caption>
                        <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Líder</th>
                            <th>Rede</th>
                        </thead>
                        <tbody>
                        <?php $c=0; ?>
                        <?php foreach ( $discipulos as $d) : ?>
                        <?php if($d->sexo == 'm'):  ?>
                        <tr class = "<?php echo $d->desistiu==1 ? 'error' : ''; ?>" >
                            <td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
                            <td><?php echo $d->nome ; ?></td>
                            <td><?php echo $d->getLider()->getAlcunha() ; ?></td>
                            <td><?php echo utf8_encode($d->getRede()[0]['tipoRede']); ?></td>
                        </tr>
                        <?php endif;  ?>
                        <?php endforeach ; ?>
                        </tbody>
                    </table>

                    <table class="table bordered-table">
                        <caption>Mulheres</caption>
                        <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Líder</th>
                            <th>Rede</th>
                        </thead>
                        <tbody>
                        <?php $c=0; ?>
                        <?php foreach ( $discipulos as $d) : ?>
                        <?php if($d->sexo == 'f'):  ?>
                        <tr class = "<?php echo $d->desistiu==1 ? 'error' : ''; ?>" >
                            <td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
                            <td><?php echo $d->nome ; ?></td>
                            <td><?php echo $d->getLider()->getAlcunha() ; ?></td>
                            <td><?php echo utf8_encode($d->getRede()[0]['tipoRede']); ?></td>
                        </tr>
                        <?php endif;  ?>
                        <?php endforeach ; ?>
                        </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="messages">
                    <?php foreach ( $redes as $rede) : ?>
                    <?php $c=0; ?>
                    <table class="table bordered-table well well-mini">
                        <caption><?php echo $rede->nome ; ?></caption>
                        <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Líder</th>
                        </thead>
                        <tbody>
                        <?php foreach ( $discipulos as $d) : ?>
                        <?php if(utf8_encode($d->getRede()[0]['tipoRede']) == $rede->nome):  ?>
                        <tr class = "<?php echo $d->desistiu==1 ? 'error' : ''; ?>" >
                            <td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
                            <td><?php echo $d->nome ; ?></td>
                            <td><?php echo $d->getLider()->getAlcunha() ; ?></td>
                        </tr>
                        <?php endif;  ?>
                        <?php endforeach ; ?>
                        </tbody>
                    </table>
                    <?php endforeach ; ?>
                </div>
              </div>
            </div>
           <article>
            </article>
        </section>
        </section>
    </body>
</html>
