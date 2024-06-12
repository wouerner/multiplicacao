<?php 

namespace admissao\controlador; 

class admissao{
	
	public function index(){

		//$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1 ;
		$admissaos =	new \Admissao\Modelo\TipoAdmissao();
		//$admissaos =	$admissaos->listarTodos(8);
		$admissaos = $admissaos->listarTodos();
		///$totalDiscipulos = \admissao\Modelo\Discipulo::totalDiscipulos();
		//$totalDiscipulos --;

			require_once  'modulos/admissao/visao/listar.php';
	
	
	}

	public function listarTipoAdmissao(){
		
		$tipoAdmissoes =	new \Admissao\Modelo\TipoAdmissao();
		$tipoAdmissoes = $tipoAdmissoes->listarTodos();

		require_once  'modulos/admissao/visao/listarTipoAdmissao.php';
	}

	public function novo($url){
	
				 $post = $url['post'] ;
			if ( empty ( $url['post'] ) ) {
		    	 require_once  'modulos/admissao/visao/novo.php';
			
			}else {
				 $admissao =	new \Admissao\Modelo\Admissao();

				 $admissao->discipuloId = $post['discipuloId'] ;
				 $admissao->tipoAdmissao = $post['tipoAdmissao'] ;

				 if($admissao->salvar()){
				 
				 }else {
				 	$admissao->atualizar();
				 
				 }
				 header ('location:/discipulo/detalhar/id/'.$post['discipuloId']);
				 exit();
			}
	}

	public function novoTipoAdmissao($url){
	
			if ( empty ( $url['post'] ) ) {
		    	 require_once  'modulos/Admissao/visao/novoTipoAdmissao.php';
			
			}else {
				 $admissao =	new \Admissao\Modelo\TipoAdmissao();

				 $post = $url['post'] ;
				 $admissao->nome = $post['nome'] ;

				 $admissao->salvar();
				 header ('location:/admissao/listarTipoAdmissao');
				 exit();
			}
	}
	
	public function atualizarTipoAdmissao($url){

			if ( empty ( $url['post'] ) ) {

				$tipoAdmissao =	new \Admissao\Modelo\TipoAdmissao();

				$tipoAdmissao->id =  $url[3] ;
				$tipoAdmissao = $tipoAdmissao->listarUm();

				require_once  'modulos/admissao/visao/atualizarTipoAdmissao.php';
			
			}else {
				$tipoAdmissao =	new \Admissao\Modelo\TipoAdmissao();

				$post = $url['post'] ;

				$tipoAdmissao->id = $post['id'];	
				$tipoAdmissao->nome = $post['nome'];

				$tipoAdmissao->atualizar();


				header ('location:/admissao/atualizarTipoAdmissao/id/'.$tipoAdmissao->id);
				exit();
			}

		
		
		}

		public function excluirTipoAdmissao($url){
				$tipoAdmissao =	new \Admissao\Modelo\TipoAdmissao();
				$tipoAdmissao->id = $url[3]; 
				$tipoAdmissao->excluir();

				$_SESSION['mensagem'] = !is_null($tipoAdmissao->erro) ? $tipoAdmissao->erro : null ;
				header ('location:/admissao/listarTipoAdmissao');
				exit();
		}

		public function excluirEventoDiscipulo($url){
				$admissao =	new \Admissao\Modelo\AdmissaoDiscipulo();
				$admissao->admissaoId = $url[3];
				$admissao->discipuloId = $url[4];

				$admissao->excluir();
				header ('location:/discipulo/admissao/id/'.$admissao->discipuloId);
				exit();
		
		}


		public function detalhar ($url) {

			$admissao = new \Admissao\Modelo\Admissao() ;

			$admissao->id = $url[3] ; 
			$admissao = $admissao->listarUm() ;
		
			require 'admissao/visao/detalhar.php' ;	
		
		}

}
