<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    </head>
    <body class="container-fluid">
		<header>
			<nav>
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>
			</nav>
		</header>
        <h1 class="text-center">Relatorio geral de ofertas</h1>
        <form id="form" class="form-inline well well-small">
            <fieldset>
                <legend>Tipos de oferta</legend>
                <?php foreach($tipoOferta as $tipo) : ?>
                    <div class="checkbox">
                        <label>
                            <input class="form-control" value="<?php echo $tipo['id']?>" type="checkbox" name="id[]"> <?php echo $tipo['nome']?>
                        </label>
                    </div>
                <?php endforeach ?>
            </fieldset>
            <fieldset>
                <legend>Inativos:</legend>
                <div class="checkbox">
                <label>
                    <input class="form-control" value="1" type="checkbox" name="inativos"> mostrar inativos?
                </label>
                </div>
            </fieldset>
            <fieldset>
                <legend>Meses</legend>
                    <div class="form-group">
                        <label>
                            Inicio
                        </label>
                            <input id="inicio" class="form-control" value="1" name="inicio">
                    </div>
                    <div class="form-group">
                        <label>
                            Fim
                        </label>
                        <input  id="fim" class="form-control" value="12" name="fim">
                    </div>
                    <div class="form-group">
                        <label>Rede</label>
                        <select class="form-control" name="rede">
                            <option value="0"> Todos</option>
                            <?php foreach($tiposRede as $rede): ?>
                                <option value="<?php echo $rede->id ?>">
                                    <?php echo $rede->nome; ?>
                                </option>
                            <?php endforeach ?>
                        </select >
                    </div>
            </fieldset>
            <fieldset>
                <legend>Ações</legend>
                <button id="btnOk" class="btn  btn-primary"><i class="fa fa-filter"></i> Filtrar</button>
                <a class="btn btn-default" href="/oferta/oferta/geral"><i class="fa fa-refresh"></i> Reiniciar</a>
            </fieldset>
        </form>
        <hr>
        <?php foreach ($relatorios as $relatorio): ?>
            <?php if ($relatorio['mostrar'] || $inativos): ?>
                <table class="table table-bordered table-condensed well well-small">
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
                                         <span class="label label-default">
                                            <?php //var_dump($oferta)?>
                                            <?php echo $o['nome']?>:
                                            <?php echo $o['valor']?>
                                          </span><br/>
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
