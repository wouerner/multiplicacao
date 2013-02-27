<?php

namespace painel\controlador; 

	class painel{
		/* Mostra a lista de todos os discipulos cadastrados no sistema
		*
		* */
	
		public function index(){


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

				  require_once  'modulos/painel/visao/painel.php';
		}

	
	}


