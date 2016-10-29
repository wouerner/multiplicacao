<?php
use \StatusCelular\Modelo\TipoStatusCelular ;
use \StatusCelular\Modelo\StatusCelular ;
use \Discipulo\Modelo\Discipulo ;

namespace statusCelular\controlador;


	class statusCelular{

		public function index(){


//			require_once  'modulos/Discipulo/visao/listar.php';


		}
		public function novo($url){
			if ( empty ( $url['post'] ) ) {
				$tiposStatusCelulares =	new \StatusCelular\Modelo\TipoStatusCelular() ;
			 	$statusCelularDiscipulo =	new \StatusCelular\Modelo\StatusCelular() ;

			 	$tiposStatusCelulares = $tiposStatusCelulares->listarTodos();

				$statusCelularDiscipulo->discipuloId= $url[4];

				$historico = $statusCelularDiscipulo->listarTodosStatus();

				$statusCelularDiscipulo = $statusCelularDiscipulo->pegarStatusCelular();

				$discipulo = new \Discipulo\Modelo\Discipulo() ;
				$discipulo->id = $url[4] ;
				$discipulo = $discipulo->listarUm();

				require_once  'modulos/statusCelular/visao/novo.php';

			}else {
				$statusCelular =	new \StatusCelular\Modelo\StatusCelular();

				$post = $url['post'] ;
				$statusCelular->discipuloId = $post['discipuloId'];
				$statusCelular->tipoStatusCelular = $post['tipoStatusCelular'];

					if ($statusCelular->salvar()){
						header ('location:/statusCelular/statusCelular/novo/id/'.$statusCelular->discipuloId);
						exit();
					}else {
						$statusCelular->atualizar();
						header ('location:/discipulo/discipulo/detalhar/id/'.$statusCelular->discipuloId);
						exit();

					}
			}


		}

		public function novoTipoStatusCelular($url){
			if ( empty ( $url['post'] ) ) {

				require_once  'modulos/statusCelular/visao/novoTipoStatus.php' ;

			}else{

			$tipoStatusCelular =	new \StatusCelular\Modelo\TipoStatusCelular() ;

			$post = $url['post'] ;
			$tipoStatusCelular->nome = $post['nome'] ;
			$tipoStatusCelular->descricao = $post['descricao'] ;
			$tipoStatusCelular->ordem = $post['ordem'] ;
			$tipoStatusCelular->cor = $post['cor'] ;

			$tipoStatusCelular->salvar();
				header ('location:/statusCelular/listarTipoStatusCelular') ;
				exit();
			}


		}

		public function listarTipoStatusCelular(){

				  $tipoStatusCelulares =	new \StatusCelular\Modelo\TipoStatusCelular();
				  $tipoStatusCelulares = $tipoStatusCelulares->listarTodos();

				  require 'modulos/statusCelular/visao/listarTipoStatusCelular.php' ;

		}

		public function atualizar($url){

			if ( empty ( $url['post'] ) ) {

				$discipulo =	new \Discipulo\Modelo\Discipulo();
				$lideres = $discipulo->listarLideres();

				$discipulo->id =  $url[4] ;
				$discipulo = $discipulo->listarUm();

				$lider =	new \Discipulo\Modelo\Discipulo();
				$lider->id = $discipulo['lider'] ;
				$lider = $lider->listarUm($discipulo['lider']);

				$celula = new \Celula\Modelo\Celula();
				$celula->id = $discipulo['celula'];
				$celula = $celula->listarUm();

				$celulas = new \Celula\Modelo\Celula();
				$celulas = $celulas->listarTodos();




				require_once  'modulos/Discipulo/visao/atualizar.php';

			}else {
				$discipulo =	new \Discipulo\Modelo\Discipulo();

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

		public function atualizarTipoStatusCelular($url){

			if ( empty ( $url['post'] ) ) {

				$tipoStatusCelular =	new \StatusCelular\Modelo\TipoStatusCelular();
				$tipoStatusCelular->id = $url[4] ;
				$tipoStatusCelular = $tipoStatusCelular->listarUm();

				require_once  'modulos/statusCelular/visao/atualizarTipoStatus.php';
			}else {
				$tipoStatusCelular =	new \StatusCelular\Modelo\TipoStatusCelular();

				$post = $url['post'] ;

				$tipoStatusCelular->id = $post['id'];
				$tipoStatusCelular->nome = $post['nome'];
				$tipoStatusCelular->descricao = $post['descricao'];
				$tipoStatusCelular->ordem = $post['ordem'];
				$tipoStatusCelular->cor = $post['cor'];

				$tipoStatusCelular->atualizar();
				header ('location:/statusCelular/statusCelular/atualizarTipoStatusCelular/id/'.$tipoStatusCelular->id);
				exit();
			}

		}

		public function excluirTipoStatusCelular($url){
				$tipoStatusCelular =	new \StatusCelular\Modelo\TipoStatusCelular();
				$tipoStatusCelular->id = $url[4];
				$tipoStatusCelular->excluir();

				$_SESSION['mensagem'] = !is_null($tipoStatusCelular->erro) ? $tipoStatusCelular->erro : null ;

				header ('location:/statusCelular/statusCelular/listarTipoStatusCelular');
				exit();
		}


		public function detalhar ($url) {

			$status = new \StatusCelular\Modelo\TipoStatusCelular() ;

			$status->id = $url[4] ;
			$status = $status->listarUm() ;

			require 'statusCelular/visao/detalhar.php' ;

		}


		public function chamar () {

			$nome = (!empty($_GET['nome'])) ? $_GET['nome'] : NULL;
			$discipulo =	new \Discipulo\Modelo\Discipulo();
			$discipulo->nome = $nome;
			$discipulos = $discipulo->chamar($nome);
			require_once 'Discipulo/visao/chamar.php' ;


		}

		public function evento($url){


			if ( empty ( $url['post'] ) ) {

				  $eventos = new \Evento\Modelo\Evento();

				  $id = $url[3];
				  $eventosDiscipulos = $eventos->listarTodosDiscipulo($id);
				$eventos = $eventos->listarTodos();


			require_once 'modulos/Discipulo/visao/evento.php' ;
			}else {
					  $post = $url['post'];
					 $discipuloEvento = new \Evento\Modelo\Evento();
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

		public function excluir($url){


			$id = $url[4] ;
			$discipulo = $url[6] ;

			$status = new \StatusCelular\Modelo\StatusCelular() ;
			$status->id = $id ;
			$status->excluir();
			header ('location:/statusCelular/statusCelular/novo/id/'.$discipulo);
			exit();


		}

		public function listarDiscipulosPorStatus($url){
			$id = $url[4] ;

			$status = new \StatusCelular\Modelo\StatusCelular() ;
			$status->tipoStatusCelular = (int)$id ;

			$discipulos = $status->listarStatusCelularPorTipo();

			$discipulosInativos = $status->discipulosInativos();
			$discipulosArquivo = $status->discipulosArquivo();

			$totalDiscipulos = count($discipulos);
			$totalArquivo = count($discipulosArquivo);
			$totalInativos = count($discipulosInativos);

			$cont = 0 ;

			$tipoStatus = new \StatusCelular\Modelo\TipoStatusCelular() ;
			$tipoStatus->id = (int)$id ;
			$tipoStatus = $tipoStatus->listarUm() ;

			require 'statusCelular/visao/discipuloPorStatus.php' ;

		}

	}

?>
