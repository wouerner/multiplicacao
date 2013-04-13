<td colspan = "2" >
	<a href="/discipulo/discipulo/atualizar/id/<?php echo $discipulo->id ?>" class = "btn btn-mini btn-primary " >
		<i class="icon-edit icon-white"></i>
	</a>

	<?php if ($acesso->hasPermission('admin_acesso') == true): ?>

	<a id = "" href="/discipulo/foto/novo/id/<?php echo $discipulo->id ; ?>" class = "btn btn-mini " alt = "" ><i class="icon-picture "></i></a>

		<?php if ($discipulo->ativo == 1 ) : ?>
	<a id = "<?php echo $discipulo->id ?>" href="#" class = "btn btn-mini btn-warning " alt = "Desativar" ><i class="icon-arrow-down icon-white"></i></a>
		<?php else : ?>
	<a id = "<?php echo $discipulo->id ; ?>" href="#" class = "btn btn-mini btn-success " alt = "ativar" ><i class="icon-arrow-up icon-white"></i></a>

		<?php endif ; ?>
	<?php endif ; ?>

	<a target="blank" id = "" href="/discipulo/discipulo/cartao/id/<?php echo $discipulo->id ?>" class = "btn btn-mini btn-info " alt = "Cartão" ><i class="icon-file icon-white"></i></a>
	<?php if ($discipulo->eLider() ) : ?>
	<a target="blank" id = "" href="/discipulo/discipulo/listarPorLider/id/<?php echo $discipulo->id ?>" class = "btn btn-mini btn-info " alt = "Discipulos por líder" ><i class="icon-user icon-white"></i> Discs</a>
	<?php endif ; ?>
	
		<a id = "<?php echo $discipulo->id ?>" href="/encontroComDeus/participantesEncontro/novoParticipante/id/<?php echo $discipulo->id ?>" class = "btn btn-mini" alt = "" > Enc. com Deus</a>
		<a id = "<?php echo $discipulo->id ?>" href="/encontroComDeus/equipe/novoMembro/id/<?php echo $discipulo->id ?>" class = "btn btn-mini" alt = "" > Equipe Encontro</a>
<?php if ($acesso->hasPermission('admin_acesso') == true): ?>
		<a id = "<?php echo $discipulo->id ?>" href="/discipulo/discipulo/excluir/id/<?php echo $discipulo->id ?>" class = "btn btn-mini btn-danger" alt = "excluir" ><i class="icon-remove icon-white"></i></a>
<?php endif ; ?>

</td>
