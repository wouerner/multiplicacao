<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ; ?>
		<?php include 'incluidos/js.inc.php' ; ?>
	</head>
	<body>
		<main class="container-fluid">
            <header>
                <nav>
                <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
                </nav>
            </header>
            <section>
                <article class="row">
                    <div class="col-md-12">
                        <form action = "/consolidacao/consolidacao/salvar" method = "post"  class = "" >
                            <legend>Atualizar Consolidação</legend>
                            <fieldset>
                                <input type = "hidden" name="discipuloId" value ="<?php echo $discipulo->id ; ?>" >
                                <input type = "hidden" name="consolidadorId" value ="<?php echo $_SESSION['usuario_id'] ?>" >
                                <div class="form-group">
                                    <label class=""><h4><?php echo $discipulo->nome; ?></h4></label>
                                </div>
                                <div class="form-group">
                                    <label class="obs">Observação :</label>
                                    <input name="observacao" type="text" class="form-control" id="obs" placeholder="">
                                </div>
                                <button type="submit" class="btn btn-success" >Salvar</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </article>
                <article class="row">
                    <div class="col-md-12">
                        <table class="table table-condensed table-striped" >
                            <thead>
                                <caption><h4>Histórico</h4></caption>
                                <tr><th>Nº</th>
                                    <th>Status</th>
                                    <th>Observação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($historico as $h) : ?>
                                    <tr>
                                        <td><?php echo isset($cont)? ++$cont : $cont=1 ?></td>
                                        <td><a href = " #" ><?php echo  $h->nome ; ?></a></td>
                                        <td><?php echo $h->observacao; ?></td>
                                    </tr>
                                <?php endforeach ; ?>
                            </tbody>
                        </table>
                </article>
            </section>
	</main>
</html>
