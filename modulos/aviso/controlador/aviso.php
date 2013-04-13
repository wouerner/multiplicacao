<?php 

namespace aviso\controlador; 

class aviso{
	
	public function index(){

		$avisos =	new \aviso\modelo\aviso();
		$avisos = $avisos->listarTodos();

		require_once  'modulos/aviso/visao/listar.php';
	
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

	
		public function excluir($url){
				$aviso =	new \aviso\modelo\aviso();
				$aviso->id = $url[4]; 
				$aviso->excluir();

				header ('location:/aviso/aviso');
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
