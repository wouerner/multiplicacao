<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
			<?php include 'incluidos/css.inc.php' ; ?>
			<?php include 'incluidos/js.inc.php' ; ?>
	</head>

	<body>
		<section class = "container-fluid">

		<nav> 
			
			<?php include 'modulos/menu/visao/menu.inc.php' ; ?>	
		</nav>
		<section>		
			<article>

				<div class = "row-fluid" >	
				<div class = "span12" >

				<table class = "table table-striped table-condensed well ">
				<caption><h3>Ranking: <?php echo $nomeRank ; ?> </h3></caption>
					<thead>
						<th>#</th>
						<th>Líder</th>
						<th>Total</th>
					</thead>

				<?php foreach ( $rank as $r ) : ?>
				<tr>
					<td><?php echo !isset($n) ? $n = 1 : ++$n ; ?></td>
					<td><?php echo $r['lider'] ; ?></td>
					<td><?php echo $r['total'] ; ?></td>
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


