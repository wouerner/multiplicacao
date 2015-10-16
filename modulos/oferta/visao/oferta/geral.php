<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
    </head>
    <body class="container">
		<header>
			<nav>
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>
			</nav>
		</header>
        <table class="table table-bordered">
        <?php foreach ($relatorios as $relatorio): ?>
            <tr>
                <td colspan="12">
                    <a href="/oferta/oferta/novo/<?php echo $relatorio['id']?>">
                        <?php echo $relatorio['nome']?>
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                <table class="table table-bordered">
                    <tr >
                        <?php foreach ($relatorio['ofertas'] as $key =>$oferta): ?>
                            <td><?php echo($key)?></td>
                        <?php endforeach;?>
                    </tr>
                    <tr >
                    <?php foreach ($relatorio['ofertas'] as $key =>$oferta): ?>
                            <?php if($oferta):?>
                                <td class="<?php echo !$oferta ? 'warning' : 'info' ?>">
                                <?php foreach ($oferta as $o): ?>
                                    <?php //var_dump($oferta)?>
                                        <?php echo $o['nome']?>:
                                        <?php echo $o['valor']?>,
                                <?php endforeach;?>
                                    </td>
                            <?php else:?>
                                    <td class="warning">
                                    </td>
                            <?php endif?>
                    <?php endforeach;?>
                    </tr>
                </table>
                </td>
            </tr>
        <?php endforeach;?>
        </table>
    </body>
</html>
