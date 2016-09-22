<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php include 'incluidos/css.inc.php' ; ?>
    <?php include 'incluidos/js.inc.php' ; ?>
</head>
<body>
    <section class = "container-fluid">
    <header>
        <nav>
            <?php require 'modulos/menu/visao/menu.inc.php' ; ?>
        </nav>
    </header>
    <section class="row">
        <article class="col-md-12">
            <form action = "/rede/funcaorede/atualizar" method="post" >
                  <input type = "hidden" name = "id" value = "<?php echo $funcao['id']?>">
                  <legend>Atualizar Funcao na Rede</legend>
                  <fieldset class="span6">
                  <div class="control-group ">
                      <label class = "control-label">Nome:</label>
                      <div class = "controls" >
                          <input class="control-form" name="nome"  value="<?php echo $funcao['nome'] ; ?>" required >
                      </div>
                      <label class = "control-label">Função Lider de Rede?:</label>
                      <div class="controls" >
                          <input type="checkbox" class="control-form" name="liderNome"  <?php echo $funcao['liderRede'] == 1 ? 'checked' : '' ?> value="1">
                      </div>
                      </div>
                  </fieldset>
                  <fieldset class = "span12" >
                          <div class = "form-actions" >
                              <button type = "submit" class = "btn btn-primary" >Atualizar</button>
                              <button type = "reset" class = "btn" >Cancelar</button>
                      </div>
                  </fieldset>
            </form>
        </article>
    </section>
    </section>
</body>
</html>
