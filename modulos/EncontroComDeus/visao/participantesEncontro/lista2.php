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
                                </thead>
                                <?php foreach ( $discipulos as $d) : ?>
                                <tr class = "<?php echo $d->desistiu==1 ? 'error' : ''; ?>" >
                                    <td><?php echo !isset($c) ? $c=1 : ++$c ; ?></td>
                                    <td><?php echo $d->nome ; ?></td>
                                    <td><?php echo !empty($d->getLider()) ? $d->getLider()->getAlcunha() : null ; ?></td>
                                    <td><?php echo $d->getRede() ? utf8_encode($d->getRede()[0]['tipoRede']) : null; ?></td>
                                </tr>
                                <?php endforeach ; ?>
                        </table>
                    </div>
                </div>
              </div>
            </div>
           <article>
            </article>
        </section>
        </section>
    </body>
</html>
