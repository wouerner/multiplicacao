<?php

namespace painel\controlador; 

	class painel{
		/* Mostra a lista de todos os discipulos cadastrados no sistema
		*
		* */
	
		public function index(){

					$usuarioId= $_SESSION['usuario_id'];
					$status = new \statusCelular\modelo\statusCelular() ;	
					$status = $status->quantidadePorStatusCelular();

					$totalDiscipulos = null;
					foreach($status as $s){
							$totalDiscipulos += (int) $s['total'] ;
					}

					foreach($status as $k => $v){
							$porc [$k]= $v ;
							$porc [$k]['porcentagem']= (100 *  $porc[$k]['total'])/$totalDiscipulos ;
					}

					$status = $porc ;

					//$porcentagem = (100 * $totalDiscipulos)/$totalDiscipulos ; 

					$statusDiscipulos = new \statusCelular\modelo\statusCelular() ;	
					$statusDiscipulos = $statusDiscipulos->pegarStatusCelularPorLider($_SESSION['usuario_id']);
					$statusDiscipulosTotal = null ; 

					foreach($statusDiscipulos as $st){
						$statusDiscipulosTotal += $st['total'];
					
					}

					$totalAtivos =  \discipulo\Modelo\Discipulo::totalAtivos() ;
					$totalInativos = \discipulo\Modelo\Discipulo::totalInativos() ;

					$totalAtivosLider =  \discipulo\Modelo\Discipulo::totalAtivosLider($usuarioId) ;
					$totalInativosLider = \discipulo\Modelo\Discipulo::totalInativosLider($usuarioId) ;


					$totalRedes =  \rede\modelo\rede::pegarTodasRedes();
					$totalRedesLideres =  \rede\modelo\rede::pegarTodasRedesPorLider($usuarioId);
				//var_dump($totalRedes);	
					$somaRede=NULL;
					foreach($totalRedes as $t){
						$somaRede += $t['total'];
					}

					$somaRedeDiscipulos=NULL;
					foreach($totalRedesLideres as $t){
						$somaRedeDiscipulos += $t['total'];
					}
					
					$avisos = new \aviso\modelo\aviso();
					$avisos = $avisos->listarUltimos();
					//var_dump($avisos);

					$celulas =	new \celula\modelo\celula();
					$celulas->lider = $usuarioId;
					$celulas = $celulas->listarCelulasLider();
					$totalCelulas = count($celulas);

					$discipulos = new \discipulo\Modelo\Discipulo();	
					$discipulos->id = $usuarioId ; 
		  		$discipulos = $discipulos->listarDiscipulos();

					$totalDiscipulos = count($discipulos) ;

					//aniversarios
					
					$discipulosAniver = new \discipulo\Modelo\Discipulo();	
					$discipulosAniver = $discipulosAniver->aniversarioHoje();	
					$totalAniver = count($discipulosAniver);	
					$contator = 0 ;

				  require_once  'modulos/painel/visao/painel.php';
		}

	
	}


