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
        <form id="form" class="form-inline">
            <fieldset>
                <legend>Tipos de oferta</legend>
                <?php foreach($tipoOferta as $tipo) : ?>
                    <label>
                        <input class="form-control" value="<?php echo $tipo['id']?>" type="checkbox" name="id[]"> <?php echo $tipo['nome']?>
                    </label>
                <?php endforeach ?>
            </fieldset>
            <fieldset>
                <label>
                    <input class="form-control" value="1" type="checkbox" name="inativos"> mostrar inativos?
                </label>
            </fieldset>
            <fieldset>
                <legend>Meses</legend>
                <label>
                    Inicio
                </label>
                    <input id="inicio" class="form-control" value="1" name="inicio">
                <label>
                    Fim
                </label>
                <input  id="fim" class="form-control" value="12" name="fim">
                <button id="btnOk" class="btn btn-default">Filtrar</button>
                <a class="btn btn-primary" href="/oferta/oferta/geral">Reiniciar</a>
            </fieldset>
        </form>
        <hr>
        <?php foreach ($relatorios as $relatorio): ?>
            <?php if ($relatorio['mostrar'] || $inativos): ?>
                <table class="table table-bordered table-condensed">
                    <tr >
                        <td rowspan="2">
                            <a href="/oferta/oferta/novo/<?php echo $relatorio['id']?>">
                                <?php echo $relatorio['nome']?>
                            </a>
                        </td>
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
        <?php endif;?>
        <?php endforeach;?>
        <script>
            jQuery("#btnOk").on('click', function(){
                //window.location = '/oferta/oferta/geral?inicio='+jQuery("#inicio")+'fim'+jQuery("#fim");
                console.log(jQuery("#form").serialize());
            });
        </script>
    </body>
</html>
