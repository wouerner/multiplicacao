<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
			<?php include 'incluidos/css.inc.php' ; ?>
			<?php include 'incluidos/js.inc.php' ; ?>
			<script>
			$(document).ready(function() 
    { 
        $("table").tablesorter(); 

$(".btn-success").click( function(){
				var id = this.id ;

				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:240,
				modal: true,
				buttons: {
			Cancelar: function() {
				$( this ).dialog( "close" );
			},
       Ativar: function() {
										$(location).attr('href', '/discipulo/discipulo/ativar/id/'+id);
       },
}
});
});

$(".btn-danger").click( function(){
	var id = this.id ;

	$( "#dialog-excluir" )
		.dialog({
			resizable: false,
			height:240,
			modal: true,
			buttons: {
				Cancelar: function() {	$( this ).dialog( "close" );	},
      	Excluir: 	function() {	$(location).attr('href', '/discipulo/discipulo/excluir/id/'+id); },
			}
		});
});

}); 
			</script>

	</head>

	<body>
<div id="dialog-confirm" title="Deseja Ativar?" style = "display:none" >
<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">
</span>Após a ativação, o líder terá acesso ao cadastro.</p>
</div>

<div id="dialog-excluir" title="Deseja excluir?" style = "display:none" >
<p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;">
</span>Essa ação não pode ser desfeita.</p>
</div>

		<section class = "container-fluid">

		<nav> 
			
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
		<section>		
			<article>

				<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
				<div class = "row-fluid" >	
				<div class = "span12" >

				<table class = "table bordered-table well table-condensed table-hover ">
				<caption><h3>Lista de Discipulos: Inativos <?php echo $total?> </h3></caption>
					<thead>
						<?php if ($acesso->hasPermission('admin_acesso') == true) : ?>
						<th class = "info" >Líder</th>
						<?php endif ; ?>
						<th>Nome</th>
						<th>Telefone</th>
						<?php if ($acesso->hasPermission('admin_acesso') == true) : ?>
						<th>Ações</th>
						<?php endif ; ?>
					</thead>

				<?php foreach ( $discipulos as $discipulo) : ?>

				<tr>
						<?php if ($acesso->hasPermission('admin_acesso') == true) : ?>
					<td><a href="/discipulo/discipulo/detalhar/id/<?php $lider = $discipulo->getLider() ; echo  is_object($lider)?$lider->id: '' ?>" ><?php echo is_object ($lider) ? $lider->nome : '' ; ?></a></td>
						<?php endif ; ?>
					<td><a href="/discipulo/discipulo/detalhar/id/<?php echo $discipulo->id?>" ><strong><?php echo $discipulo->nome ; ?></strong></a></td>
				<td><?php echo $discipulo->telefone ; ?></td> 

						<?php if ($acesso->hasPermission('admin_acesso') == true) : ?>
				<td><button class = "btn btn-success btn-mini" id ="<?php echo $discipulo->id ; ?>" ><i class = "icon-arrow-up icon-white" ></i>Ativar</button></td>
				<td><a href="/discipulo/discipulo/arquivar/id/<?php echo $discipulo->id ; ?>" class = "btn btn-inverse btn-mini" id ="<?php echo $discipulo->id ; ?>" ><i class = "icon-inbox icon-white" ></i>Arquivar</button></td>
				<td><button class = "btn btn-danger btn-mini" id ="<?php echo $discipulo->id ; ?>" ><i class = "icon-remove icon-white" ></i>Excluir</button></td>
					<?php endif ;?>
				</tr>


				
				<?php endforeach ; ?>
				</table>

				</div>
			</div>
			</article>
		
		</section>

		</section>
	</body>
</html>


