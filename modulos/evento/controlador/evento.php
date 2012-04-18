<?php 

use evento\modelo\evento;
use evento\modelo\eventoDiscipulo;
namespace evento\controlador; 

class evento{
	
	public function index(){

		//$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;
		$eventos =	new \evento\modelo\evento();
		//$eventos =	$eventos->listarTodos(8);
		$eventos = $eventos->listarTodos();
		///$totalDiscipulos = \evento\Modelo\Discipulo::totalDiscipulos();
		//$totalDiscipulos --;

			require_once  'modulos/evento/visao/listar.php';
	
	
	}

	public function novo($url){
	
			if ( empty ( $url['post'] ) ) {
		
					  require_once  'modulos/evento/visao/novo.php';
			
			}else {
				 $evento =	new \evento\modelo\evento();

				  $post = $url['post'] ;
				 $evento->nome = $post['nome'] ;

				  $evento->salvar();
				header ('location:/evento');
				exit();
			}
			
	
	
	}
		public function atualizar($url){

			if ( empty ( $url['post'] ) ) {

				$evento =	new \evento\modelo\evento();

				$evento->id =  $url[3] ;
				$evento = $evento->listarUm();

				require_once  'modulos/evento/visao/atualizar.php';
			
			}else {
				$evento =	new \evento\modelo\evento();

				$post = $url['post'] ;

				$evento->id = $post['id'];	
				$evento->nome = $post['nome'];

				$evento->atualizar();


				//$lider =	new \evento\Modelo\Discipulo();
				//$lideres = $evento->listarLideres();
				header ('location:/evento/atualizar/id/'.$evento->id);
				exit();
			}

		
		
		}

		public function excluir($url){
				$evento =	new \evento\modelo\evento();
				$evento->id = $url[3]; 
				$evento->excluir();
				header ('location:/evento');
				exit();
		
			
		
		
		}

		public function excluirEventoDiscipulo($url){
				$evento =	new \evento\modelo\eventoDiscipulo();
				$evento->eventoId = $url[3];
				$evento->discipuloId = $url[4];

				//var_dump($evento);
				//exit();

				$evento->excluir();
				header ('location:/discipulo/evento/id/'.$evento->discipuloId);
				exit();
		
			
		
		
		}


		public function detalhar ($url) {

			$evento = new \evento\modelo\evento() ;

			$evento->id = $url[3] ; 
			$evento = $evento->listarUm() ;
		
			require 'evento/visao/detalhar.php' ;	
		
		}







}
