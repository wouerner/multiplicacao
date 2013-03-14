<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php include 'incluidos/css.inc.php' ; ?>
		<?php include 'incluidos/js.inc.php' ; ?>

<script>
$(document).ready(function () {
$(".btn-warning").click( function(){
				var id = this.id ;

				$( "#dialog-confirm" ).dialog({
				resizable: false,
				height:240,
				modal: true,
				buttons: {
			Cancelar: function() {
				$( this ).dialog( "close" );
			},
      Desativar: function() {
										$(location).attr('href', '/discipulo/discipulo/desativar/id/'+id);
       },
}

});


}

); });
</script>
	</head>

	<body>
<div id="dialog-confirm" title="Deseja desativar?" style = "display:none">
    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>Quer realmente excluir?</p>
</div>
		<section class = "container-fluid">

		<nav> 
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
			
		<header>
		
		</header>

		<section>		
			<article>

			<?php require 'modulos/discipulo/visao/chamarDiscipulo.php' ; ?>
<div class = "well" >

			<table class = "table" >
				<caption><h3>Detalhes do Discipulo</h3></caption>

				<tr>	
					<td  >
					<strong>Nome:</strong>	<?php echo $discipulo->nome ; ?>
					</td>
					<td  >
					<strong>Líder: </strong>	<?php echo $discipulo->getLider()->nome ; ?>
					</td>
					<td>
						 <strong>Status Celular: </strong> <?php  echo $statusCelular['nome'] ; ?>
					</td>
				</tr>

				<tr>
					<td><strong>Endereço: </strong><?php  echo $discipulo->endereco ; ?></td>
					<td><strong>Telefone: </strong><?php echo $discipulo->telefone ; ?></td>
					<td><strong>E-mail: </strong><?php echo $discipulo->email ; ?></td>
				</tr>

				<tr >

				<td colspan = "3" ><strong>Participa da Célula: </strong>
						<a href="/celula/detalhar/id/<?php echo $discipulo->celula ; ?>">
							<?php echo $participaCelula['nomeCelula'] ; ?>
						</a>
					</td>
				</tr>
				<tr >
					<td colspan = "3" ><strong>Líder da Célula: </strong>
						<?php foreach ( $liderCelula as $celula) :?>
						<a href="/celula/detalhar/id/<?php echo $celula['id'] ; ?>">
							<?php echo $celula['nomeCelula'] ; ?> 
						</a> |
						<?php endforeach ; ?>
						  </a>
					</td>
				</tr>
				<tr>
					<td colspan = "3" > 
				<strong>Eventos:</strong> 
				<?php foreach ( $eventoDiscipulo as $evento) :?>
						<a href="/celula/detalhar/id/<?php echo $evento['id'] ; ?>">
							<?php echo $evento['nome'] ; ?> 
						</a> |
				<?php endforeach ; ?>
					</td>
				</tr>

				<tr  >
					<td colspan = "3" >Ministerios:  
				<?php foreach ( $ministerios as $ministerio) :?>
							<?php echo $ministerio['funcao'] ; ?>  
							<?php echo $ministerio['ministerio'] ; ?> 
						 |
				<?php endforeach ; ?>
					</td>
				</tr>

				<tr>
				<td>
					<table class = "table" >
						<caption>Discipulos nas Redes</caption>
						<?php foreach( $totalRedesLideres as $s) :?>
						<tr>
							<td><?php echo $s['nome']?></td>
							<td><?php echo $s['total']?></td>
						</tr>
						<?php endforeach ; ?>
					</table>
				</td>

				<td>
					<table class = "table" >
						<caption>Discipulos Ativos/Inativos</caption>
						<tr>
							<td>Discipulos ativos: <?php echo $totalAtivosLider['total'] ;  ?> </td>
							<td>Discipulos inativos: <?php echo $totalInativosLider['total'] ;  ?> </td>
						</tr>
					</table>
				</td>
				</tr>

					<?php require 'discipulo/visao/menuDiscipulo.inc.php' ; ?>
				</table>
</div>	
			
			</article>
		
		</section>

		</section>
	</body>
</html>

