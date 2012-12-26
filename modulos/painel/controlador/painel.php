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
				  require_once  'modulos/painel/visao/painel.php';
		}

	
	}


