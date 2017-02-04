<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php include 'incluidos/css.inc.php'?>
    <?php include 'incluidos/js.inc.php'?>
</head>
<body>
    <section class="container-fluid">
        <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        <section>
            <article>
                <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
                    <div class = "row-fluid" >
                        <div class = "col-md-12">
                            <table class = "  well table bordered-table">
                            <caption>Relatorio Semanal</caption>
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Função</th>
                                        <th>Nome</th>
                                        <th>Lider</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php  $cont=1;  ?>
                                        <?php foreach ( $estavel as $discipulo) : ?>
                                            <tr >
                                                <td><?php echo  $cont++  ?></td>
                                                <td><?php echo $discipulo->funcaoRedeNome ; ?></td>
                                                <td><?php echo $discipulo->discipuloNome ; ?></td>
                                                <td><?php echo $discipulo->liderNome ; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php  $cont=1;  ?>
                                        <?php foreach ( $adicionados as $discipulo) : ?>
                                            <tr class="success">
                                                <td><?php echo  $cont++  ?></td>
                                                <td><?php echo $discipulo->funcaoRedeNome ; ?></td>
                                                <td><?php echo $discipulo->discipuloNome ; ?></td>
                                                <td><?php echo $discipulo->liderNome ; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <?php  $cont=1;  ?>
                                        <?php foreach ( $sairam as $discipulo) : ?>
                                            <tr class="danger">
                                                <td><?php echo  $cont++  ?></td>
                                                <td><?php echo $discipulo->funcaoRedeNome ; ?></td>
                                                <td><?php echo $discipulo->discipuloNome ; ?></td>
                                                <td><?php echo $discipulo->liderNome ; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </article>
        </section>
        </section>
    </body>
</html>
