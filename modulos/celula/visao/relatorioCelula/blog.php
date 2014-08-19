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
    </head>
    <body>
        <section class="container-fluid">
            <header>
                <h1 class="text-center">Blog do <?php echo $celula['nome']?></h1>
            </header>
            <section>
                <article>
                    <?php foreach ( $relatorios as $r ) : ?>
                        <div class="row-fluid">
                            <div  class="span1" >
                                <div  class="span12" >
                                    <label class="label label-success">
                                        <h3>
                                            <?php echo date_format(date_create($r->dataEnvio),'d')  ; ?>
                                        </h3>
                                    </label>
                                </div>
                                <div  class="span12" >
                                    <label class="label label-info">
                                        <?php echo date_format(date_create($r->dataEnvio),'m/Y H:i')  ; ?>
                                    </label>
                                </div>
                            </div>
                            <div  class="span9" >
                                <h1><?php echo $r->titulo ; ?></h1>
                                <h2>Tema: <?php echo $r->pegarTemaRelatorio()->nome ; ?></h1>
                                <p><?php echo $r->texto ; ?></p>
                                <p> Participantes:
                                    <?php foreach ($r->listarParticipacao() as $discipulo) : ?>
                                        <label class="label label-success">
                                            <?php echo $discipulo->getNome() ?>
                                        </label>
                                    <?php endforeach?>
                                </p>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach ; ?>
                </article>
            </section>
        </section>
    </body>
</html>
