<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ?>
        <?php include 'incluidos/js.inc.php' ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
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
                    <?php if ($acesso->hasPermission('financeiro_editar') == true): ?>
                    <form action="/oferta/oferta/novo" method="post"  class="form-horizontal">
                        <fieldset>
                            <legend>Ofertas</legend>
                            <div class="form-group" >
                                <label class="control-label col-md-2" >Nome</label>
                                <div class="col-md-8">
                                    <a class="btn btn-link" href="/discipulo/detalhar/id/<?php echo $discipulo->id?>" ><?php echo $discipulo->nome; ?></a></strong>
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
                                    <input id="valor" data-thousands="" placeholder="100"  class="form-control " type="text" name="valor" required>
                                </div>
                            </div>
                            <button type = "submit" class = "btn btn-primary" >Atualizar</button>
                            <button type = "reset" class = "btn" >Limpar</button>
                        </fieldset>
                    </form>
                    <script>
                        $(function() {
                            console.log('reste');
                           $('#valor').maskMoney();
                           $("#data").datepicker();
                        });
                    </script>
                <?php endif ; ?>
                <hr>
                <?php if($ofertasDiscipulo) : ?>

                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Todas</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Por Mês</a></li>
                    </ul>

                  <!-- Tab panes -->
                    <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>Conta</th>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                    <th>Data</th>
                                    <?php if ($acesso->hasPermission('financeiro_editar') == true): ?>
                                        <th>Ações</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
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
                                            <?php echo $oferta['valor'] ; ?>
                                        </td>
                                        <?php if ($acesso->hasPermission('financeiro_editar') == true): ?>
                                            <td>
                                                <a class = "btn btn-danger" href="/oferta/oferta/excluir/id/<?php echo $oferta['0'] ; ?>/<?php echo $oferta['discipuloId']?>" >Excluir</a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach ; ?>
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <?php foreach ($ofertasMesAno as $key => $oferta) : ?>
                            <div class="col-md-6">
                                <table class = "table table-condensed well" >
                                    <caption>Mês : <?php echo $key?></caption>
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Data</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($oferta as $mes) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo $mes['nome'] ; ?>
                                                </td>
                                                <td>
                                                    <?php echo $of = implode ('/',array_reverse(explode('-',$mes['data']))) ; ?>
                                                </td>
                                                <td>
                                                    <?php echo $mes['valor'] ; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach ; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endforeach ; ?>
                    </div>
                </div>
                <?php endif ?>
            </article>
        </section>
        </section>
    </body>
</html>
