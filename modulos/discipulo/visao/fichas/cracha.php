<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<style type="text/css">
		   @import url("/ext/twitter-bootstrap/bootstrap.css");
		</style>
		<script src="../../../ext/jquery/jquery-1.7.1.min.js"></script>
		
		<style>
				body{

					font-size: 14pt;



					} 

					p{
					
					font-size: 14pt;
					line-height: 200%;


					}
					h1{
						font-size:30pt;

					
					}
					h2{
						font-size:24pt;

					
					}
					table{
					/*	margin-top:5px;*/
		
					}
					.cracha{

						/*width:500px;*/
						height:274px;
						border-color: 1px solid black;
						background : url('/modulos/discipulo/visao/fichas/cracha.png') ;
					}

					.nome{
						position: relative;
						top: 150px;
						left: 10px;
						}
					.foto{
						height:2cm;

				}
		</style>
	</head>

	<body>
		<section class = "container">

		<nav> 
		</nav>
			
		<header>
		
		</header>

		<section>		
			<article>
<div class ="container">
<?php $cont =0 ; ?>
<?php foreach( $discipulos as $discipulo ) : ?>
			<div class = "span6" style = "margin-bottom:40px ; width: 420px ;;  " >
			<table class = "  table table-bordered table-condensed cracha" style = " border:1px solid black; " >
				 <tr>
				<!--	<td class = "foto" ><img src="/modulos/discipulo/visao/img/mga.jpg"> </img></td> -->
				</tr>
				<tr>
					<!-- <td class = "" >Encontro com Deus dias 13, 14 e 15/07/2012</td> -->
				</tr>

				<tr>	
					 <div class = "nome"><h2>
					<?php 
					$discipulo = explode(' ',$discipulo->nome);
					$tamanho = count($discipulo) ;
					$nomeMeio = null;

					for( $i = 1 ; $i < $tamanho -1 ; $i ++ ){	
						if (strlen ($discipulo[$i]) > 3 ){
					 		$nomeMeio .= ' '.substr($discipulo[$i], 0, 1).'. ' ;
						}
					}
					

					echo $discipulo =  $discipulo[0].' '.$nomeMeio.' '.$discipulo[$tamanho-1]; 
				?></h2></div>
				</tr>

				</table>
</div>
<?php endforeach ; ?>
		</div>	
			</article>
		</section>

		</section>
	</body>
</html>

