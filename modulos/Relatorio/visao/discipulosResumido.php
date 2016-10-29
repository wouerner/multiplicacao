<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
        <script src="/modulos/Discipulo/visao/js/combobox.js"></script>
        <script src="/modulos/Discipulo/visao/js/comboboxCelula.js"></script>
    </head>

    <body>
        <section class = "container-fluid">
            <nav>
                <?php include 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
        <section>
            <article>
        <div class = "row" >
            <div class = "col-md-12" >
            <div class = "well" >
                <form method="post">
                    <fieldset>
                        <legend>Relátorio Dinamico</legend>
                            <div class = "row" >
                                <div class = "form-group col-md-2" >
                                    <label>Discipulo:</label>
                                    <select class = " form-control col-md-2" name = "ativo" >
                                        <option value = "1" >Ativo</option>
                                        <option value = "todos"  >Todos</option>
                                        <option value = "0" >Inativo</option>
                                    </select>
                                </div>

                                <div class = "form-group col-md-2" >
                                    <div class = "ui-widget" >
                                        <label class = "control-label" for = "lider" >Nome do Líder:</label>
                                        <select id = "combobox" class = "form-control combobox lider " name = "lider"  >
                                        <option value = "todos" selected >todos</option>
                                        <?php foreach($lideres as $lider) : ?>
                                             <option value = "<?php echo $lider->id ?>"><?php echo $lider->getAlcunha() ?> </option>
                                        <?php endforeach ; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class = "form-group col-md-2" >
                                    <label class="control-label col-md-12">Idade </label>
                                    <div class="col-md-6">
                                        <input type = "text" class = "form-control col-md-6" value = "0" type = "" name = "idadeMinima" >
                                    </div>
                                    <div class="col-md-6">
                                        <input type = "text" class = "form-control scol-md-6" value = "100" type = "" name = "idadeMaxima" >
                                    </div>
                                </div>

                                <div class = "form-group col-md-2" >
                                    <label>Sexo:</label>
                                    <select class="form-control " name = "sexo" >
                                            <option value = "todos" >Todos</option>
                                            <option value = "m" >Masculino</option>
                                            <option value = "f" >Feminino</option>
                                    </select>
                                </div>

                                <div class = "form-group col-md-2" >
                                <label>Estado Civil:</label>
                                <select  class="form-control"  name="estadoCivil" >
                                        <option value = "todos" >Todos</option>
                                    <?php foreach ( $estadoCivies as $estado) : ?>
                                        <option value = "<?php echo $estado['id'] ;?>" ><?php echo $estado['nome']?></option>
                                    <?php endforeach ; ?>
                                 </select>
                                </div>

                                <div class = "form-group col-md-2" >
                                <label>Consolidação:</label>
                                    <select  class="form-control"  name = "tipoStatusCelular" >
                                        <option value = "todos" >Todos</option>
                                    <?php foreach ( $tipoStatusCelulares as $status) : ?>
                                        <option value = "<?php echo $status->id  ;?>" ><?php echo $status->nome?></option>
                                        <?php endforeach ; ?>

                                </select>
                                </div>

                                <div class = "form-group col-md-2" >
                                <label>Célula:</label>
                                    <select class = "form-control" name = "celula" >
                                        <option value = "todos" >Todos</option>
                                    <?php foreach ( $celulas as $c) : ?>
                                        <option value = "<?php echo $c->id ; ?>" ><?php echo $c->nome ; ?></option>
                                        <?php endforeach ; ?>

                                </select>
                                </div>

                                <div class = "form-group col-md-2" >
                                <label>Rede:</label>
                                    <select class = " form-control col-md-2" name = "rede" >
                                        <option value = "todos" >Todos</option>
                                    <?php foreach ( $tipoRedes as $tp) : ?>
                                        <option value = "<?php echo $tp->id  ;?>" ><?php echo $tp->nome ?></option>
                                        <?php endforeach ; ?>

                                </select>
                                </div>
                                </div>
                                    <button class="btn btn-default" type="submit">Gerar</button>
                            </div>
                        </fieldset>
            </form>
            </div>
            </div>
    </div>
            </article>
        </section>
        </section>
    </body>
</html>
