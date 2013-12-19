<td>
    <a href="/rede/rede/listarMembrosRede/id/<?php echo $rede->id ; ?>" class = "btn btn-mini " ><i class = "icon-list" ></i> listar Discipulos </a>
    <a href="/rede/rede/listarCelulas/id/<?php echo $rede->id ; ?>" class = "btn btn-mini " ><i class = "icon-list" ></i> listar Células</a>
    <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
    <a href="/rede/rede/atualizarTipoRede/id/<?php echo $rede->id ; ?>" class = "btn btn-mini btn-primary" ><i class="icon-edit icon-white"></i> Atualizar</a>
    <a href="/rede/rede/excluirTipoRede/id/<?php echo $rede->id ; ?>" class = "btn btn-mini btn-danger" ><i class = "icon-remove icon-white" ></i> excluir</a>
    <?php endif ; ?>
</td>
