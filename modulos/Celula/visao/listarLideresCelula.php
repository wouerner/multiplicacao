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
<style type="text/css">
</style>

    </head>
    <body>
        <section class = "container">
        <nav>
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>
        <header>
        </header>
        <section>
            <article>
            <?php require 'modulos/Celula/visao/chamarCelula.php' ; ?>
            <?php if (isset($mensagem)) : ?>
                <div class="alert <?php echo ($mensagem=='ok') ? 'alert-success' : 'alert-error' ; ?>">
                    <h4 class="alert-heading">
                        <?php echo $mensagem ?>!
                    </h4>
                </div>
            <?php endif ; ?>
            <table class = "table table-condensed">
                <caption><h3>Lista de Líderes de Células</h3></caption>
                <thead>
                </thead>
                <tbody>
                <?php $total=0?>
                <?php foreach ( $lideres as $lider) : ?>
                    <tr class="">
                        <td colspan="3">
                            <h4 class="text-center">
                            <strong >
                            <a href ="/discipulo/discipulo/detalhar/id/<?php echo $lider->id ?>" ><?php echo $lider->nome ; ?></a>
                            </strong>
                            </h4>
                            <h5 class="text-center">Células:
                            <?php foreach ( $lider->getCelulaLider() as $celula) : ?>
                                <a href ="/celula/celula/detalhar/id/<?php echo $celula->id ?>" >
                                <?php echo $celula->nome?> (<?php echo count($celula->listarDiscipulos())?>)
                                </a>|
                            <?php endforeach;?>
                            </h5>
                        </td>
                        <!--td>
                            <?php //echo $lider['totalCelulas'] ; ?>
                        </td-->
                    </tr>
                <?php //foreach($lider->listarDiscipulos() as $d ):?>
                    <!--tr class="">
                        <td></td>
                        <td><?php //echo !isset($c) ? $c=1 : ++$c ; ?>
                        -- <a href ="/discipulo/discipulo/detalhar/id/<?php //echo $d->id ?>" >
                        <?php// echo $d->nome;?> <?php  //$status = $d->getStatusCelular();  ?>
                            <span class="badge"><?php //echo $status['nome']?>
                            </span>
                        </a>
                        </td>
                    </tr-->
                <?php// endforeach;?>
                    <?php $cont=0 ?>
                    <?php foreach ($statusCelulares as $status ): ?>
                                <?php $cont=0 ?>
                                <?php foreach ($lider->listarDiscipulos() as $discipulo ): ?>
                                    <?php if($discipulo->getStatusCelular() && $status->id == $discipulo->getStatusCelular()['id'] && $discipulo->ativo):?>
                                    <tr class="<?php echo $status->cor?>">
                                        <td><?php echo ++$cont ?></td>
                                        <td>
                                                <?php echo $status->nome?>
                                            </a>
                                        </td>
                                        <td>
                                            <a href ="/discipulo/discipulo/atualizar/id/<?php echo $discipulo->id ?>" >
                                                <?php echo $discipulo->getAlcunha(); ?>
                                            </a>
                                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                            <a target="blank" class="btn btn-mini btn-inverse" href="/discipulo/discipulo/arquivar/id/<?php echo $discipulo->id?>"> Arquivar</a>
                                        <?php endif?>
                                    </td>
                                    <?php endif ?>
                                </tr>
                                <?php endforeach ?>
                            </td>
                    <?php endforeach ?>
                <?php// $total += $c?>
                <?php// $c=0 ?>
            <?php endforeach ; ?>
                <!--h3>Lideres: <?php //echo count($lideres)?>-
                Discipulos: <?php //echo $total - (2*count($lideres))?></h3-->
            <tbody>
            </table>
            </article>
        </section>
        </section>
    </body>
</html>
