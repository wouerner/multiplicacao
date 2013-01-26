<?php		include("seguranca/ACL/assets/php/database.php"); 
		$acl = new \seguranca\modelo\acl($_SESSION['usuario_id']);
			
?>
			<td colspan = "2" >
					<a href="/celula/relatorio/novo/id/<?php echo $celula['id'] ; ?>" class = "btn" >Relatorio</a>
					<a href="/celula/relatorio/index/celulaId/<?php echo $celula['id'] ; ?>" class = "btn" >Lista Relatorios</a>
					<a href="/celula/atualizar/id/<?php echo $celula['id'] ; ?>" class = "btn" >Atualizar</a>

<?php if ($acl->hasPermission('admin_acesso') == true): ?>
					<a href="/celula/excluir/id/<?php echo $celula['id'] ; ?>" class = "btn btn-danger" >Excluir</a>
<?php endif ; ?>

			</td>
