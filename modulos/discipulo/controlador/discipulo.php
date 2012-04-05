<?php
use discipulo\Modelo\Discipulo;
use celula\modelo\celula;
use evento\modelo\evento;

namespace discipulo\controlador; 


	class discipulo{
	
		public function index(){

		$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;
		$discipulos =	new \discipulo\Modelo\Discipulo();
		//$discipulos =	$discipulos->listarTodos(8);
		$discipulos = $discipulos->listarTodosPag($_SESSION['usuario_id'], 3  , $pagina);
		$totalDiscipulos = \discipulo\Modelo\Discipulo::totalDiscipulos();
		$totalDiscipulos --;

			require_once  'modulos/discipulo/visao/listar.php';

		
		}
		public function novo($url){
			if ( empty ( $url['post'] ) ) {
		
			require_once  'modulos/discipulo/visao/novo.php';
			
			}else {
				$discipulo =	new \discipulo\Modelo\Discipulo();

		$post = $url['post'] ;
		$discipulo->nome = $post['nome'];
		$discipulo->telefone = $post['telefone'];
		$discipulo->endereco = $post['endereco'];
		$discipulo->email = $post['email'];
		$discipulo->usuario = $post['usuario'];
		$discipulo->senha = $post['senha'];


		$discipulo->salvar();
				header ('location:/discipulo');
				exit();
			}
			

		}

		public function atualizar($url){

			if ( empty ( $url['post'] ) ) {

				$discipulo =	new \discipulo\Modelo\Discipulo();
				$lideres = $discipulo->listarLideres();

				$discipulo->id =  $url[3] ;
				$discipulo = $discipulo->listarUm();

				$lider =	new \discipulo\Modelo\Discipulo();
				$lider->id = $discipulo['lider'] ;
				$lider = $lider->listarUm($discipulo['lider']);

				$celula = new \celula\modelo\celula();
				$celula->id = $discipulo['celula'];
				$celula = $celula->listarUm();

				$celulas = new \celula\modelo\celula();
				$celulas = $celulas->listarTodos();

				require_once  'modulos/discipulo/visao/atualizar.php';
			
			}else {
				$discipulo =	new \discipulo\Modelo\Discipulo();

				$post = $url['post'] ;

				$discipulo->id = $post['id'];	
				$discipulo->nome = $post['nome'];
				$discipulo->telefone = $post['telefone'];
				$discipulo->endereco = $post['endereco'];
				$discipulo->email = $post['email'];
				$discipulo->celula = $post['celula'];
				$discipulo->ativo =isset( $post['ativo']) ? $post['ativo']: null;
				$discipulo->lider = $post['lider'];

				$discipulo->atualizar();

				header ('location:/discipulo/atualizar/id/'.$discipulo->id);
				exit();
			}
		
		}

		public function excluir($url){
			echo "aki";
				$discipulo =	new \discipulo\Modelo\Discipulo();
				$discipulo->id = $url[3]; 
				$discipulo->excluir();
				header ('location:/discipulo');
				exit();
		
		}


		public function detalhar ($url) {

			$discipulo = new \discipulo\Modelo\Discipulo() ;

			$discipulo->id = $url[3] ; 
			$discipulo = $discipulo->listarUm() ;
		
			require 'discipulo/visao/detalhar.php' ;	
		
		}


		public function chamar () {

			$nome = (!empty($_GET['nome'])) ? $_GET['nome'] : NULL;
			$discipulo =	new \discipulo\Modelo\Discipulo();
			$discipulo->nome = $nome; 
			$discipulos = $discipulo->chamar($nome);	
			require_once 'discipulo/visao/chamar.php' ;

		
		}
	
		public function evento($url){
			

			if ( empty ( $url['post'] ) ) {

				  $eventos = new \evento\modelo\evento();
				
				  $id = $url[3];
				  $eventosDiscipulos = $eventos->listarTodosDiscipulo($id);
				$eventos = $eventos->listarTodos();


			require_once 'modulos/discipulo/visao/evento.php' ;
			}else {
					  $post = $url['post'];
					 $discipuloEvento = new \evento\modelo\evento();
					  $eventoId = $post['eventoId'];
						$discipuloId = $post['discipuloId'];

					 $discipuloEvento->salvarDiscipuloEvento($discipuloId, $eventoId );	

					  echo "url" ;
					 var_dump($url);
					 $id = $post['discipuloId'];

					 header ('location:/discipulo/evento/id/'.$id);
					 exit();
			
				
			
			
			}
				
		
		}	
	
	}	

?>
