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
        <style>
            #blog-back {
                background:url('ext/img/night_sky.jpg');
            }
        </style>
    </head>
    <body id="blog-back">
        <section class="container-fluid">
            <header>
                <h1 class="text-center"><?php echo $celula->nome?></h1>
            </header>
            <section>
                <article>
                    <div class="row-fluid">
                    <div  class="span10" >
                    <?php foreach ( $relatorios as $r ) : ?>
                        <div class="row-fluid">
                            <div  class="span1" >
                                <img src="<?php echo $lider->getFoto()->url ?>">
                                <label class="label label-info">
                                    <?php echo date_format(date_create($r->dataEnvio),'d/m/Y')  ; ?>
                                </label>
                            </div>
                            <div  class="span11 well well-small" >
                                <h3><?php echo $r->titulo ; ?></h3>
                                <h4>Tema: <?php echo $r->pegarTemaRelatorio()->nome ; ?></h4>
                                <blockquote>
                                    <p><?php echo $r->texto ; ?></p>
                                </blockquote>
                                <p> Participantes:
                                    <?php foreach ($r->listarParticipacao() as $discipulo) : ?>
                                        <label class="label label-success">
                                            <?php echo $discipulo->getNome() ?>
                                        </label>
                                    <?php endforeach?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach ; ?>
                            </div>
                        <div  class="span2" >
                            <img src="<?php echo $lider->getFoto()->url ?>">
                            <p><?php echo $lider->nome?></p>
                            <strong>Discípulos:</strong>
                            <?php foreach ($discipulos as $discipulo) : ?>
                                <label class="label label-info">
                                    <?php echo $discipulo->nome ?>
                                </label>
                            <?php endforeach ?>
                            </div>
                    </div>
                </article>
            </section>
        </section>
    </body>
</html>
