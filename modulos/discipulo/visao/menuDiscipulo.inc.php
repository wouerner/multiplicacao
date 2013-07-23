<td colspan = "2" >

    <a href="/discipulo/discipulo/atualizar/id/<?php echo $discipulo->id ?>" class = "btn btn-mini btn-primary " >
        <i class="icon-edit icon-white"></i> Atualizar
    </a>

    <?php if ($discipulo->eLider() ) : ?>
    <a target="blank" id = "" href="/discipulo/discipulo/listarPorLider/id/<?php echo $discipulo->id ?>" class = "btn btn-mini btn-info " alt = "Discipulos por líder" ><i class="icon-user icon-white"></i> Discs</a>
    <?php endif ; ?>

<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
        <a id = "<?php echo $discipulo->id ?>" href="/metas/metas/novo/id/<?php echo $discipulo->id ?>" class = "btn btn-mini " alt = "excluir" ><i class="icon-screenshot "></i> Cadastrar Meta</a>
        <a id = "<?php echo $discipulo->id ?>" href="/metas/metas/detalhar/id/<?php echo $discipulo->id ?>" class = "btn btn-mini " alt = "excluir" ><i class="icon-screenshot "></i>Metas</a>
<?php endif ; ?>

        <a id = "<?php echo $discipulo->id ?>" href="/metas/participantesMetas/novo/id/<?php echo $discipulo->id ?>" class = "btn btn-mini " alt = "" ><i class="icon-group icon-white"></i>Participantes da Meta</a>

    <div class="btn-group">
        <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
            Encontro 
            <span class="caret"></span>
        </a>
    <ul class="dropdown-menu">
        <a id = "<?php echo $discipulo->id ?>" href="/encontroComDeus/participantesEncontro/novoParticipante/id/<?php echo $discipulo->id ?>" class = "btn btn-mini" alt = "" > Encontro</a>
        <a id = "<?php echo $discipulo->id ?>" href="/encontroComDeus/equipe/novoMembro/id/<?php echo $discipulo->id ?>" class = "btn btn-mini" alt = "" > Equipe Encontro</a>

    </ul>
    </div>

        <a id="<?php echo $discipulo->id ?>" href="/batismo/batismo/novo/id/<?php echo $discipulo->id ?>" class = "btn btn-mini" alt = "" > Batismo</a>

        <?php if ($discipulo->ativo == 1 ) : ?>
    <a id = "<?php echo $discipulo->id ?>" href="#" class = "btn btn-mini btn-warning " alt = "Desativar" ><i class="icon-arrow-down icon-white"></i>Desativar</a>
        <?php else : ?>
    <a id = "<?php echo $discipulo->id ; ?>" href="#" class = "btn btn-mini btn-success " alt = "ativar" ><i class="icon-arrow-up icon-white"></i>Ativar</a>
        <?php endif ; ?>

<?php if ($acesso->hasPermission('admin_acesso') == true): ?>

    <a id = "<?php echo $discipulo->id ; ?>" href="/discipulo/discipulo/arquivar/id/<?php echo $discipulo->id?>" 
       class = "btn btn-mini btn-inverse " >
        <i class=""></i>Arquivar
    </a>
        <a id = "<?php echo $discipulo->id ?>" href="/discipulo/discipulo/excluir/id/<?php echo $discipulo->id ?>" class = "btn btn-mini btn-danger" alt = "excluir" ><i class="icon-remove icon-white"></i>excluir</a>

<?php endif ; ?>
</td>
