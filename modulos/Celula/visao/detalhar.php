<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
    </head>
    <body>
        <section class = "container-fluid">
        <nav>
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>
        <header>
        </header>
        <section>
            <article>
                        <div class = "well" >
                        <table class = "table table-bordered">
                            <caption><h3>Célula: <?php echo $celula->nome?></h3></a></caption>
                            <tr>
                                <td class = "" ><h4><a href= "/discipulo/discipulo/detalhar/id/<?php echo $celula->pegaLider()->id ; ?>" >Líder: <?php echo $celula->pegaLider()->nome ; ?> </a></h4></td>
                                <td class = "span6" ><h4>Célula: <?php echo $celula->nome ; ?> </h4></td>
                                <?php require 'Celula/visao/menuCelula.inc.php' ; ?></tr>
                            <tr>
                                <td>Endereço:<?php echo $celula->endereco ; ?>	</td>
                                <td>Horario:<?php echo $celula->horarioFuncionamento ; ?></td>
                            </tr>

                            <tr>
                            </table>

                            <table class = "table table-bordered table-condensed" >
                            <caption><h4>Lista de discipulos</h4></caption>

                            <?php $cont= 0 ?>

                            <?php foreach ($discipulos as $discipulo) : ?>
                                    <tr>
                                        <td>
                                             <a target = "blank" href = "/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id ; ?>"> <strong><?php echo $discipulo->nome;?></strong></a>
                                             <a class="btn btn-mini btn-primary" target = "blank" href = "/discipulo/discipulo/atualizar/id/<?php echo $discipulo->id ; ?>"> Atualizar</a>
                                             <a class="btn btn-mini btn-inverse" target="blank" href="/discipulo/discipulo/arquivar/id/<?php echo $discipulo->id ; ?>"> Arquivar</strong></a>
                                        </td>
                                    </tr>
                            <?php endforeach ; ?>
                        </table>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
