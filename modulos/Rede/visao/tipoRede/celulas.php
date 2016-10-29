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
        <section class = "container-fluid">
        <nav>
            <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>
        <section>
            <article>
                <?php require 'modulos/Discipulo/visao/chamarDiscipulo.php' ; ?>
                <div class = "row-fluid" >
                <div class = "span12" >
                        <div class = "well" >
                        <table class = "table table-condensed">
                            <caption>
                                <h3>Lista de Células Edificação</h3>
                            </caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Endereço</th>
                                    <th>Horário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ( $celulas as $c ) : ?>
                                <?php if ($c->multiplicacao==0): ?>
                                <tr>
                                    <td><?php echo isset($a)? ++$a:$a= 1 ; ?></td>
                                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                        <td><a href="/celula/celula/detalhar/id/<?php echo $c->id?>" ><?php echo $c->nome ; ?> </a></td>
                                        <td><?php echo $c->endereco ; ?></td>
                                        <td><?php echo $c->horarioFuncionamento ; ?></td>
                                        <?php else : ?>
                                        <td><?php echo $c->nome ; ?></td>
                                        <td><?php echo $c->endereco ; ?></td>
                                        <td><?php echo $c->horarioFuncionamento ; ?></td>
                                        <?php endif ; ?>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach ; ?>
                            </tbody>
                        </table>
                        <table class = "table table-condensed">
                            <caption>
                                <h3>Lista de Células</h3>
                            </caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Endereço</th>
                                    <th>Horário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ( $celulas as $c ) : ?>
                                <?php if ($c->multiplicacao==1 && $c->ativa==1): ?>
                                <tr>
                                    <td><?php echo isset($b)? ++$b: $b=1 ; ?></td>
                                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                        <td><a href="/celula/celula/detalhar/id/<?php echo $c->id?>" ><?php echo $c->nome ; ?> </a></td>
                                        <td><?php echo $c->endereco ; ?></td>
                                        <td><?php echo $c->horarioFuncionamento ; ?></td>
                                        <?php else : ?>
                                        <td><?php echo $c->nome ; ?></td>
                                        <td><?php echo $c->endereco ; ?></td>
                                        <td><?php echo $c->horarioFuncionamento ; ?></td>
                                        <?php endif ; ?>
                                </tr>
                                <?php endif ; ?>
                                <?php endforeach ; ?>
                            </tbody>
                        </table>
                        <table class = "table table-condensed">
                            <caption><h3>Lista de Células Inativas</h3></caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Endereço</th>
                                    <th>Horário</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ( $celulas as $c ) : ?>
                                <?php if ($c->ativa==0): ?>
                                <tr>
                                    <td><?php echo ++$cont ; ?></td>
                                        <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
                                        <td><a href="/celula/celula/detalhar/id/<?php echo $c->id?>" ><?php echo $c->nome ; ?> </a></td>
                                        <td><?php echo $c->endereco ; ?></td>
                                        <td><?php echo $c->horarioFuncionamento ; ?></td>
                                        <?php else : ?>
                                        <td><?php echo $c->nome ; ?></td>
                                        <td><?php echo $c->endereco ; ?></td>
                                        <td><?php echo $c->horarioFuncionamento ; ?></td>
                                        <?php endif ; ?>
                                </tr>
                                    <?php endif; ?>
                                <?php endforeach ; ?>
                            </tbody>
                        </table>
                    </div>
            </div>
            </div>
            </div>
            </article>

        </section>

        </section>
    </body>
</html>
