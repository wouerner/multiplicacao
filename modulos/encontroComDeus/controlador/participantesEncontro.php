<?php
namespace encontroComDeus\controlador; 

use \discipulo\Modelo\Discipulo as discipulo;

class participantesEncontro {
	
	public function index($url){

		$participante = new \encontroComDeus\modelo\participantesEncontro() ;
		$participante->encontroComDeusId =$url[4] ;
		$discipulos = $participante->listarTodos();

		$total = count ($discipulos) ;
		$ativo = 'active' ;


		require_once  'modulos/encontroComDeus/visao/participantesEncontro/listarTodos.php';

	}

	public function novo($url){

		$encontroId = $url[4] ;
	  if ( empty ( $url['post'] ) ) {

			$discipulos = new discipulo();
			$discipulos = $discipulos->listarTodos($_SESSION['usuario_id']);
			require_once  'modulos/encontroComDeus/visao/participantesEncontro/novo.php';
			
		}else {

		$post = $url['post'] ;

		$participantes = new \encontroComDeus\modelo\participantesEncontro() ;

		$participantes->encontroComDeusId = $post['encontroId'] ;
		$participantes->salvarMuitos($post['participantes']) ;

		header ('location:/encontroComDeus/encontroComDeus' );
		exit();
		}
			

		}

	public function novoParticipante($url){
		$id = $url[4] ;
		
	  if ( empty ( $url['post'] ) ) {
		$discipulo = new discipulo();
		$discipulo->id = $id ; 
		$discipulo = $discipulo->listarUm();

		$encontro = new \encontroComDeus\modelo\encontroComDeus();
		$encontro = $encontro->listarTodos();
		
		}else{
		$post = $url['post'] ;
		$participantes = new \encontroComDeus\modelo\participantesEncontro() ;

		$participantes->encontroComDeusId = $post['encontroId'] ;
		$participantes->discipuloId = $post['id'] ;
		$participantes->salvar() ;

		header ('location:/discipulo/discipulo' );
		exit();
		}
		require_once  'modulos/encontroComDeus/visao/participantesEncontro/novoParticipante.php';


	}

	public function preEncontroAtivar($url){
					
		$participante = new \encontroComDeus\modelo\participantesEncontro();
		$participante->id = $url[4] ;
		$participante->preEncontroAtivar();
		$redirecionar = $_SERVER['HTTP_REFERER'];
		//var_dump($redirecionar);exit();
		header ('location:'.$redirecionar );
	}

	public function preEncontroDesativar($url){
					
		$participante = new \encontroComDeus\modelo\participantesEncontro();
		$participante->id = $url[4] ;
		$participante->preEncontroDesativar();
		$redirecionar = $_SERVER['HTTP_REFERER'];
		//var_dump($redirecionar);exit();
		header ('location:'.$redirecionar );
	}

	public function encontroAtivar($url){
					
		$participante = new \encontroComDeus\modelo\participantesEncontro();
		$participante->id = $url[4] ;
		$participante->encontroAtivar();
		$redirecionar = $_SERVER['HTTP_REFERER'];
		//var_dump($redirecionar);exit();
		header ('location:'.$redirecionar );
	}

	public function encontroDesativar($url){
					
		$participante = new \encontroComDeus\modelo\participantesEncontro();
		$participante->id = $url[4] ;
		$participante->encontroDesativar();
		$redirecionar = $_SERVER['HTTP_REFERER'];
		header ('location:'.$redirecionar );
	}

	public function posEncontroAtivar($url){
					
		$participante = new \encontroComDeus\modelo\participantesEncontro();
		$participante->id = $url[4] ;
		$participante->posEncontroAtivar();
		$redirecionar = $_SERVER['HTTP_REFERER'];
		header ('location:'.$redirecionar );
	}

	public function posEncontroDesativar($url){
					
		$participante = new \encontroComDeus\modelo\participantesEncontro();
		$participante->id = $url[4] ;
		$participante->posEncontroDesativar();
		$redirecionar = $_SERVER['HTTP_REFERER'];
		header ('location:'.$redirecionar );
	}

	public function desistiuAtivar($url){
					
		$participante = new \encontroComDeus\modelo\participantesEncontro();
		$participante->id = $url[4] ;
		$participante->desistiuAtivar();
		$redirecionar = $_SERVER['HTTP_REFERER'];
		header ('location:'.$redirecionar );
	}

	public function desistiuDesativar($url){
					
		$participante = new \encontroComDeus\modelo\participantesEncontro();
		$participante->id = $url[4] ;
		$participante->desistiuDesativar();
		$redirecionar = $_SERVER['HTTP_REFERER'];
		header ('location:'.$redirecionar );
	}

	public function preEncontro($url){
					
		$participante = new \encontroComDeus\modelo\participantesEncontro();
		$participante->encontroComDeusId = $url[4] ;
		$discipulos = $participante->preEncontroAtivos();
		$discipulosInativos = $participante->preEncontroInativos();
		$total = count ($discipulos) ;
		$totalInativos = count ($discipulosInativos) ;
		$preEncontro= 'active';
		require_once  'modulos/encontroComDeus/visao/participantesEncontro/listar.php';
		//header ('location:/encontroComDeus/participantesEncontro/x/id/'.$url[4] );
	}
	public function encontro($url){
					
		$participante = new \encontroComDeus\modelo\participantesEncontro();
		$participante->encontroComDeusId = $url[4] ;
		$discipulos = $participante->encontroAtivos();
		$discipulosInativos = $participante->encontroInativos();
		$total = count ($discipulos) ;
		$totalInativos = count ($discipulosInativos) ;
		$encontro= 'active';
		require_once  'modulos/encontroComDeus/visao/participantesEncontro/listar.php';
		//header ('location:/encontroComDeus/participantesEncontro/x/id/'.$url[4] );
	}
	public function posEncontro($url){
					
		$participante = new \encontroComDeus\modelo\participantesEncontro();
		$participante->encontroComDeusId = $url[4] ;
		$discipulos = $participante->posEncontroAtivos();
		$discipulosInativos = $participante->posEncontroInativos();
		$total = count ($discipulos) ;
		$totalInativos = count ($discipulosInativos) ;
		$posEncontro= 'active';
		require_once  'modulos/encontroComDeus/visao/participantesEncontro/listar.php';
		//header ('location:/encontroComDeus/participantesEncontro/x/id/'.$url[4] );
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

		public function novaFuncao($url){
			if ( empty ( $url['post'] ) ) {
		
				require_once  'modulos/ministerio/visao/novaFuncao.php' ;
			
			}else{

			$funcao =	new \ministerio\modelo\funcao() ; 

			$post = $url['post'] ;
			$funcao->nome = $post['nome'] ;

			$funcao->salvar();
			header ('location:/ministerio/listarFuncao') ;
			exit();
			}
			

		}

		public function listarMinisterio(){

				  $ministerios =	new \ministerio\modelo\ministerio();
				  $ministerios = $ministerios->listarTodos();

				  require 'modulos/ministerio/visao/listarMinisterio.php' ; 
		
		}

		public function listarFuncao(){

				  $funcoes =	new \ministerio\modelo\funcao();
				  $funcoes = $funcoes->listarTodos();

				  require 'modulos/ministerio/visao/listarFuncao.php' ; 
		
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

		public function atualizarFuncao($url){

			if ( empty ( $url['post'] ) ) {


				$funcao =	new \ministerio\modelo\funcao();
				$funcao->id = $url[3] ;
				$funcao = $funcao->listarUm();

				require_once  'modulos/ministerio/visao/atualizarFuncao.php';
			
			}else {
				$funcao =	new \ministerio\modelo\funcao();

				$post = $url['post'] ;

				$funcao->id = $post['id'];	
				$funcao->nome = $post['nome'];

				$funcao->atualizarFuncao();

				header ('location:/ministerio/atualizarFuncao/id/'.$funcao->id);
				exit();
			}
		
		}

		public function excluir($url){
				$participante =	new \encontroComDeus\modelo\participantesEncontro();
				$participante->id = $url[4]; 
				$participante->excluir();

				$redirecionar = $_SERVER['HTTP_REFERER'];
				header ('location:'.$redirecionar );
				exit();
		}

		public function excluirFuncao($url){
				$funcao =	new \ministerio\modelo\funcao();
				$funcao->id = $url[3]; 
				$funcao->excluir();

				$_SESSION['mensagem'] = !is_null($funcao->erro) ? $funcao->erro : null ;
				header ('location:/ministerio/listarFuncao');
				exit();
		}



		public function detalhar ($url) {

			$discipulo = new \discipulo\Modelo\Discipulo() ;

			$discipulo->id = $url[3] ; 
			$discipulo = $discipulo->listarUm() ;
		
			require 'discipulo/visao/detalhar.php' ;	
		
		}

		public function detalharFuncao ($url) {

			$funcao = new \ministerio\modelo\funcao() ;

			$funcao->id = $url[3] ; 
			$funcao = $funcao->listarUm() ;
		
			require 'ministerio/visao/detalharFuncao.php' ;	
		
		}

		public function detalharMinisterio ($url) {

			$ministerio = new \ministerio\modelo\ministerio() ;

			$ministerio->id = $url[3] ; 
			$ministerio = $ministerio->listarUm() ;
		
			require 'ministerio/visao/detalharMinisterio.php' ;	
		
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
