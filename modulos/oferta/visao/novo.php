<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
	</head>
	<body>
		<section class="container">
            <header>
                <nav>
                <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
                </nav>
            </header>
		<section>
			<article>
                <form action="/oferta/oferta/novo" method="post"  class="form-horizontal">
                    <fieldset>
                        <legend>Ofertas</legend>
						<div class="form-group" >
                            <label class="control-label col-md-2" >Nome</label>
                            <div class="col-md-8">
                                <a class="btn btn-link"href = "/discipulo/detalhar/id/<?php echo $discipulo->id?>" ><?php echo $discipulo->nome; ?></a></strong>
                                <input type="hidden" name="discipuloId" value="<?php echo $discipulo->id ; ?>" >
                            </div>
                        </div>
						<div class="form-group" >
                            <label class = "control-label col-md-2" >Tipo da Oferta</label>
                            <div class="col-md-8">
                                <select class="form-control col-md-8" name = "tipoOfertaId" >
                                    <?php foreach ($tiposOfertas as $tipoOferta) : ?>
                                        <option value = "<?php echo $tipoOferta ['id'] ; ?>" ><?php echo $tipoOferta ['nome'] ; ?></option>
                                    <?php endforeach ; ?>
                                </select>
                            </div>
						</div>
                        <div class="form-group" >
                            <label class="control-label col-md-2">Conta:</label>
                            <div class="col-md-8">
                                <select class="form-control " name="conta" >
                                    <?php foreach ($contas as $conta) : ?>
                                        <option value = "<?php echo $conta->id; ?>" ><?php echo $conta->nome; ?></option>
                                    <?php endforeach ; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class = "control-label col-md-2" >Data da Oferta:</label>
                            <div class="col-md-4">
                                <input placeholder="dd/mm/aaaa" id="data" class="form-control " type="date" name="data" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class = "control-label col-md-2">Valor:</label>
                            <div class="col-md-4">
                                <input placeholder="100"  class="form-control " type="" name="valor" required>
                            </div>
                        </div>
                        <button type = "submit" class = "btn btn-primary" >Atualizar</button>
                        <button type = "reset" class = "btn" >Limpar</button>
                    </div>
				</fieldset>
            </form>
            <table class = "table" >
                <thead>
                    <th>Conta</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </thead>
                    <?php foreach ($ofertasDiscipulo as $oferta) : ?>
                        <tr>
                            <td>
                                <?php echo $oferta['contaNome'] ; ?>
                            </td>
                            <td>
                                <?php echo $oferta['nomeOferta'] ; ?>
                            </td>
                            <td>
                                <?php echo $of = implode ('/',array_reverse(explode('-',$oferta['data']))) ; ?>
                            </td>
                            <td>
                            <a class = "btn btn-danger" href="/oferta/oferta/excluir/id/<?php echo $oferta['0'] ; ?>/<?php echo $oferta['discipuloId']?>" >Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach ; ?>
            </table>
            </article>
        </section>
        </section>
        <script>
        $(function() {
                  $("#data" ).datepicker();
        });
        </script>
    </body>
</html>
