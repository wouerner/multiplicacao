<?php
use \discipulo\Modelo\Discipulo ;

namespace ministerio\controlador; 


	class ministerio{
	
		public function index(){


//			require_once  'modulos/discipulo/visao/listar.php';

		
		}
		public function novo($url){
				  if ( empty ( $url['post'] ) ) {

			

			 $tiposOfertas =	new \ministerio\modelo\ministerio() ; 
			 $ministerioDiscipulo =	new \ministerio\modelo\ministerio() ;


			 $tiposOfertas = $tiposOfertas->listarTodos();	
			
			 $ministerioDiscipulo->discipuloId= $url[3];
			 //$ministerioDiscipulo = $ministerioDiscipulo->pegarOferta();


			$discipulo = new \discipulo\Modelo\Discipulo() ;
			$discipulo->id = $url[3] ;
			$discipulo = $discipulo->listarUm();
		
			require_once  'modulos/ministerio/visao/novo.php';
			
			}else {
				$ministerio =	new \ministerio\modelo\ministerio();

		$post = $url['post'] ;
		$ministerio->discipuloId = $post['discipuloId'];
		$ministerio->ministerioId = $post['ministerioId'];
		$ministerio->dataOferta = $post['dataOferta'];


//		var_dump($ministerio);
//		exit();


		if ($ministerio->salvar()){

				header ('location:/discipulo/detalhar/id/'.$ministerio->discipuloId);
				exit();
		}else {
				  $ministerio->atualizar();
				header ('location:/discipulo/detalhar/id/'.$ministerio->discipuloId);
				exit();
		
		
		}
			}
			

		}

		public function novoMinisterio($url){
			if ( empty ( $url['post'] ) ) {
		
				require_once  'modulos/ministerio/visao/novoMinisterio.php' ;
			
			}else{

			$ministerio =	new \ministerio\modelo\ministerio() ; 

			$post = $url['post'] ;
			$ministerio->nome = $post['nome'] ;

			$ministerio->salvar();
			header ('location:/ministerio/listarMinisterio') ;
			exit();
			}
			

		}

		public function listarMinisterio(){

				  $ministerios =	new \ministerio\modelo\ministerio();
				  $ministerios = $ministerios->listarTodos();

				  require 'modulos/ministerio/visao/listarMinisterio.php' ; 
		
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

		public function atualizarMinisterio($url){

			if ( empty ( $url['post'] ) ) {


				$ministerio =	new \ministerio\modelo\ministerio();
				$ministerio->id = $url[3] ;
				$ministerio = $ministerio->listarUm();

				require_once  'modulos/ministerio/visao/atualizarMinisterio.php';
			
			}else {
				$ministerio =	new \ministerio\modelo\ministerio();

				$post = $url['post'] ;

				$ministerio->id = $post['id'];	
				$ministerio->nome = $post['nome'];

				$ministerio->atualizarMinisterio();

				header ('location:/ministerio/atualizarMinisterio/id/'.$ministerio->id);
				exit();
			}
		
		}

		public function excluirMinisterio($url){
				$ministerio =	new \ministerio\modelo\ministerio();
				$ministerio->id = $url[3]; 
				$ministerio->excluir();
				header ('location:/ministerio/listarMinisterio');
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
