<td>
    <?php if ($acesso->hasPermission('admin_acesso') == true): ?>
        <a href="/governo/governo/atualizar/id/<?php echo $governo->id ; ?>" class = "btn btn-mini btn-primary" >
            <i class="icon-edit icon-white"></i> Atualizar</a>
        <a href="/governo/governo/excluir/id/<?php echo $governo->id ; ?>" class = "btn btn-mini btn-danger" >
            <i class = "icon-remove icon-white" ></i> excluir</a>
    <?php endif ; ?>
</td>
