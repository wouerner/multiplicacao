<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <?php include 'incluidos/css.inc.php' ; ?>
        <?php include 'incluidos/js.inc.php' ; ?>
    </head>

    <body>
        <section class = "container">
        <header>
            <nav>
                <?php require 'modulos/menu/visao/menu.inc.php' ; ?>
            </nav>
        </header>

        <section>
            <article>
                    <form action = "/discipulo/atualizar" method = "post"  class = "form-horizontal">

                    <div class = "row" >
                              <fieldset class = "span6" >
                                  <legend>Dados Do Discipulo</legend>

                              <div class="control-group ">
                                  <label class = "control-label" >Nome:</label>
                                  <div class = "controls" >
                                      <input name = "nome"  value = "<?php echo $discipulo['nome'] ; ?>" >
                                  </div>
                                  </div>

                              <div class="control-group ">
                                  <label class = "control-label" >Ativo:</label>
                                  <div class = "controls" >
                                      <input name = "ativo" type = "checkbox"
                                          value = "<?php echo ($discipulo['ativo'] != TRUE )? TRUE : 0 ; ?>" <?php  echo ($discipulo['ativo'] == TRUE )? "checked" :"" ; ?> >
                                  </div>
                                  </div>

                              <div class="control-group ">
                                  <label class = "control-label" >Telefone:</label>
                                  <div class = "controls" >
                                      <input name = "telefone"  value = "<?php echo $discipulo['telefone']?>" >
                                  </div>
                                  </div>

                              <div class="control-group ">
                                  <label class = "control-label" >Endereço:</label>
                                      <div class = "controls" >
                                  <input name = "endereco" value = "<?php echo $discipulo['endereco']?>">
                                  </div>
                                  </div>

                              <div class="control-group ">
                                  <label class = "control-label" >E-mail:</label>
                                  <div class = "controls" >
                                      <input name = "email" type = "email" value = "<?php echo $discipulo['email']?>">
                                  </div>
                                  </div>

                              <div class="control-group ">
                                  <label class = "control-label" >Nível</label>
                                  <div class = "controls" >
                                      <input name = "nivel" value = "<?php echo $discipulo['nivel']?>">
                                  </div>
                                  </div>

                                  <input type = "hidden" name = "id" value = "<?php echo $discipulo['id']?>">

                              </fieldset>

                              <fieldset class = "span6" >
                                  <legend>Visão Celular</legend>
                                         <div class="control-group ">
                                             <label class = "control-label" >Líder</label>
                                             <div class = "controls" >
                                                 <select name = "lider" required >

                                                 <option value = "<?php echo $lider['id']?>"><?php echo $lider['nome']?> </option>
                                                 <option>--------- </option>

                                                 <?php foreach($lideres as $lider) : ?>
                                                 <option value = "<?php echo $lider['id']?>"><?php echo $lider['nome']?> </option>
                                                 <?php endforeach ; ?>

                                                 </select>
                                             </div>
                                     </div>

                              <div class="control-group ">
                                  <label class = "control-label" >Célula</label>
                                  <div class = "controls" >

                                      <select name = "celula" required >
                                      <option value = "<?php echo $celula['id']?>"><?php echo $celula['nome']?> </option>
                                      <option>--------- </option>

                                      <?php foreach($celulas as $celula) : ?>
                                      <option value = "<?php echo $celula['id']?>"><?php echo $celula['nome']?> </option>
                                      <?php endforeach ; ?>

                                  </select>
                                  </div>
                                  </div>

                              <div class="control-group ">
                                  <label class = "control-label" >Status Celular</label>
                                  <div class = "controls" >

                                      <select name = "statusCelular" required >
                                      <option value = "<?php echo $celula['id']?>"><?php echo $celula['nome']?> </option>
                                      <option>--------- </option>

                                      <?php foreach($celulas as $celula) : ?>
                                      <option value = "<?php echo $celula['id']?>"><?php echo $celula['nome']?> </option>
                                      <?php endforeach ; ?>

                                  </select>
                                  </div>
                                  </div>

                              </fieldset>

                              <fieldset class = "span12" >
                                      <div class = "form-actions" >
                                          <button type = "submit" class = "btn btn-primary" >Atualizar</button>
                                          <button type = "reset" class = "btn" >Cancelar</button>
                                  </div>
                              </fieldset>

                    </div>

                    </form>

            </article>

        </section>

        </section>
    </body>

</html>
