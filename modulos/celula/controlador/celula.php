<?php
use celula\modelo\celula;
use discipulo\Modelo\Discipulo;
namespace celula\controlador; 


	class celula{
	
		public function index(){

		//$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;
		$celulas =	new \celula\modelo\celula();
		$celulas = $celulas->listarTodos();
		//$totalDiscipulos = \discipulo\Modelo\Discipulo::totalDiscipulos();
		//$totalDiscipulos --;

			require_once  'modulos/celula/visao/listar.php';

		
		}
		public function novo($url){
			if ( empty ( $url['post'] ) ) {
				
				$lideres = new \discipulo\Modelo\Discipulo(); 
				$lideres = $lideres->listarLideres();
	
				require_once  'modulos/celula/visao/novo.php';
			
			}else {
				$celula =	new \celula\modelo\celula();

				$post = $url['post'] ;
				$celula->nome = $post['nome'];
				$celula->horarioFuncionamento = $post['horarioFuncionamento'];
				$celula->endereco = $post['endereco'];
				$celula->lider = $post['lider'];

				$celula->salvar();
				header ('location:/celula');
				exit();
			}
			

		}

		public function atualizar($url){

			if ( empty ( $url['post'] ) ) {

				$celula =	new \celula\modelo\celula();
				$lideres = $celula->listarLideres();

				$celula->id =  $url[3] ;
				$celula = $celula->listarUm();

				$lider =	new \discipulo\Modelo\Discipulo();
				$lider->id = $celula['lider'] ;
				$lider = $lider->listarUm($celula['lider']);



				var_dump($lider);
				var_dump($celula);



		
				require_once  'modulos/celula/visao/atualizar.php';
			
			}else {

				$celula =	new \celula\modelo\celula();

				$post = $url['post'] ;
				$celula->nome = $post['nome'];
				$celula->horarioFuncionamento = $post['horarioFuncionamento'];
				$celula->endereco = $post['endereco'];
				$celula->lider = $post['lider'];
				$celula->id = $post['id'];

				$celula->atualizar();

				header ('location:/celula/atualizar/id/'.$celula->id);
				exit();
			}

		
		
		}

		public function excluir($url){
				$celula =	new \celula\modelo\celula();
				$celula->id = $url[3]; 
				$celula->excluir();
				header ('location:/celula');
				exit();
		
			
		
		
		}

		public function detalhar($url){

			$celula =	new \celula\modelo\celula();
			$celula->id = $url[3]; 
			$discipulos= $celula->listarDiscipulos();
			$celula = $celula->listarUm();
				
			require 'celula/visao/detalhar.php' ;
				
		
		}


		public function chamar () {

			$nome = $_GET['nome'];
			$celula =	new \celula\modelo\celula();
			$celula->nome = $nome; 
			$celulas = $celula->chamar($nome);	
			require_once 'celula/visao/chamar.php' ;

		
		}
	
	
	
	}	

?>