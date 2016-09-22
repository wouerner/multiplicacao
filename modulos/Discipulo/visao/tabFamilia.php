<form action = "/discipulo/discipulo/atualizar" method="post"  class="" accept-charset = "UTF-8" >
    <fieldset>
        <legend>Dados da Familia</legend>
        <div class="row" >
            <div class="form-group col-md-3" >
                <label class="control-label" for="lider" >Nome Conjuge</label>
                <select id="conjuge" class="form-control" name="conjuge">
                    <?php foreach($lideres as $lider) : ?>
                    <option <?php echo ($discipulo->conjuge == $lider->id) ? 'selected' : '';?> value="<?php echo $lider->id; ?>">
                        <?php echo $lider->getAlcunha() ?> </option>

                    <?php endforeach ; ?>
                 </select>
                 <script type="text/javascript">
                      jQuery('#conjuge').select2();
                 </script>
            </div>
        </div>
    </fieldset>
    <div class = "form-actions " >
        <input type = "hidden" id="discipuloIdFamilia" name="discipuloId" value = "<?php echo $discipulo->id; ?>" >
        <button id="conjugeSubmit" type = "submit" class = "btn btn-success" ><i class = "icon-pencil icon-white" ></i> Salvar</button>
    </div>
</form>
<script type="text/javascript">
jQuery("#conjugeSubmit").on( "click", function(e){
    e.preventDefault();

    $.post( "/discipulo/familia/conjuge",
            {discipuloId: jQuery("#discipuloIdFamilia").val(),
            conjuge: jQuery("#conjuge :selected").val() },
            function() {
        alert( "success" );
        })
        .fail(function() {
        alert( "error" );
        })
        .always(function() {
        alert( "finished" );
        });
});
</script>
