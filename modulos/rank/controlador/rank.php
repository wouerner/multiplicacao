<?php 

namespace aviso\controlador; 

class aviso{
	
	public function index(){

		$avisos =	new \aviso\modelo\aviso();
		$avisos = $avisos->listarTodos();

		require_once  'modulos/aviso/visao/listar.php';
	
	}

	public function listarTipoAdmissao(){

		$tipoAdmissoes =	new \admissao\modelo\tipoAdmissao();
		$tipoAdmissoes = $tipoAdmissoes->listarTodos();

		require_once  'modulos/admissao/visao/listarTipoAdmissao.php';
	}

	public function novo($url){
	
				 $post = $url['post'] ;
			if ( empty ( $url['post'] ) ) {
		    	 require_once  'modulos/admissao/visao/novo.php';
			
			}else {
				 $admissao =	new \admissao\modelo\admissao();

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
		    	 require_once  'modulos/admissao/visao/novoTipoAdmissao.php';
			
			}else {
				 $admissao =	new \admissao\modelo\tipoAdmissao();

				 $post = $url['post'] ;
				 $admissao->nome = $post['nome'] ;

				 $admissao->salvar();
				 header ('location:/admissao/listarTipoAdmissao');
				 exit();
			}
	}
	
	public function atualizarTipoAdmissao($url){

			if ( empty ( $url['post'] ) ) {

				$tipoAdmissao =	new \admissao\modelo\tipoAdmissao();

				$tipoAdmissao->id =  $url[3] ;
				$tipoAdmissao = $tipoAdmissao->listarUm();

				require_once  'modulos/admissao/visao/atualizarTipoAdmissao.php';
			
			}else {
				$tipoAdmissao =	new \admissao\modelo\tipoAdmissao();

				$post = $url['post'] ;

				$tipoAdmissao->id = $post['id'];	
				$tipoAdmissao->nome = $post['nome'];

				$tipoAdmissao->atualizar();


				header ('location:/admissao/atualizarTipoAdmissao/id/'.$tipoAdmissao->id);
				exit();
			}

		
		
		}

		public function excluirTipoAdmissao($url){
				$tipoAdmissao =	new \admissao\modelo\tipoAdmissao();
				$tipoAdmissao->id = $url[3]; 
				$tipoAdmissao->excluir();

				$_SESSION['mensagem'] = !is_null($tipoAdmissao->erro) ? $tipoAdmissao->erro : null ;
				header ('location:/admissao/listarTipoAdmissao');
				exit();
		}

		public function excluirEventoDiscipulo($url){
				$admissao =	new \admissao\modelo\admissaoDiscipulo();
				$admissao->admissaoId = $url[3];
				$admissao->discipuloId = $url[4];

				$admissao->excluir();
				header ('location:/discipulo/admissao/id/'.$admissao->discipuloId);
				exit();
		
		}


		public function detalhar ($url) {

			$admissao = new \admissao\modelo\admissao() ;

			$admissao->id = $url[3] ; 
			$admissao = $admissao->listarUm() ;
		
			require 'admissao/visao/detalhar.php' ;	
		
		}

}
