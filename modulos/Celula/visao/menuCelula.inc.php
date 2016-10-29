<?php		//include("seguranca/ACL/assets/php/database.php");
        $acl = new \Seguranca\Modelo\Acl($_SESSION['usuario_id']);

?>
            <td colspan = "2" >
                    <a href="/celula/celula/participacao/id/<?php echo $celula->id ; ?>" class = "btn btn-sm btn-info" >Participação</a>
                    <a href="/celula/relatorio/novo/id/<?php echo $celula->id ; ?>" class = "btn btn-sm btn-success" ><i class = "icon-plus icon-white" ></i>Relatorio</a>
                    <a href="/celula/relatorio/index/celulaId/<?php echo $celula->id ; ?>" class = "btn btn-sm" ><i class = "icon-list" ></i> Relatorios</a>
                    <a href="/celula/celula/atualizar/id/<?php echo $celula->id ; ?>" class = "btn btn-sm btn-primary" ><i class = "icon-edit icon-white" ></i></a>

<?php if ($acl->hasPermission('admin_acesso') == true): ?>
                    <a href="/celula/celula/excluir/id/<?php echo $celula->id ; ?>" class = "btn btn-danger btn-sm" ><i class = "icon-remove icon-white" ></i></a>
<?php endif ; ?>

            </td>
