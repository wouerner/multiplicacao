<?php
use celula\modelo\celula;
use discipulo\Modelo\Discipulo;
namespace celula\controlador;
use aviso\modelo\tipoAviso;
use aviso\modelo\aviso;
use celula\modelo\relatorioCelula as relatorioModelo;
use celula\modelo\temaRelatorioCelula as temaModelo;

class relatorio{

	public function index($url){

		$relatorioCelula = new \celula\modelo\relatorioCelula();
		$relatorioCelula->celulaId  = $url[4];
		$relatorios = $relatorioCelula->listarTodos();

		require_once  'modulos/celula/visao/relatorioCelula/listar.php';

	}

		public function novo($url){
			$dataEnvio = date('d/m/Y');
			$post = $url['post'] ? $url['post'] : '' ;

			if ( empty ( $post ) ) {
				$celulaId = $url[4];

				$celula = new \celula\modelo\celula($celulaId);
				$temas = new \celula\modelo\temaRelatorioCelula();

				$temas = $temas->listarTodosAtivos();
				$lider = $celula->pegaLider();

				$discipulos = $celula->listarDiscipulos();
				require_once  'modulos/celula/visao/relatorioCelula/novo.php';
			}else{

				$relatorioCelula = new \celula\modelo\relatorioCelula() ;
				$relatorioCelula->dataEnvio = date('Y-m-d H:i:s') ;
				$relatorioCelula->texto = $post ['texto'] ;
				$relatorioCelula->titulo = $post ['titulo'] ;
				$relatorioCelula->lider = $post ['lider'] ;
				$relatorioCelula->celulaId = $post ['celulaId'] ;
				$relatorioCelula->temaRelatorioCelulaId = $post ['temaRelatorioCelulaId'] ;
				$discipulos = $post['discipulos'] ;

				$relatorioCelula->salvar();
				$relatorioCelula->salvarParticipacao($discipulos);

				$aviso = new aviso();

				$aviso->tipoAviso = tipoAviso::relatorioNovo ;
				$aviso->identificacao = $relatorioCelula->id ;
				$aviso->emissor = $_SESSION['usuario_id'];
				$aviso->salvar();

				header ('location:/celula/relatorio/index/celulaId/'.$relatorioCelula->celulaId) ;

			}

		}

		public function atualizar($url){

			if ( empty ( $url['post'] ) ) {

				$celula =	new \celula\modelo\celula();
				$lideres = $celula->listarLideres();

				$celula->id =  $url[3] ;
				$celula = $celula->listarUm() ;

				$lider =	new \discipulo\Modelo\Discipulo() ;
				$lider->id = $celula->lider ;
				$lider = $lider->listarUm($celula->lider) ;

				require_once  'modulos/celula/visao/atualizar.php' ;

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

				$_SESSION['mensagem'] = !is_null($celula->erro) ? $celula->erro : NULL ;
				header ('location:/celula');
				exit();
		
			
		
		
		}

		public function detalhar($url){

			$relatorio =	new \celula\modelo\relatorioCelula() ;
			$relatorio->id = $url[4] ; 


			$participacao = $relatorio->listarParticipacao() ; 

			$relatorio = $relatorio->listarUm() ;

			$tema = $relatorio->pegarTemaRelatorio() ;

			//var_dump($tema);
			//var_dump($participacao);
			//exit;

			require 'celula/visao/relatorioCelula/detalhar.php' ;
		
		}


		public function chamar () {

			$nome = isset($_GET['nome']) ? $_GET['nome'] : NULL ;
			$celula =	new \celula\modelo\celula();
			$celula->nome = $nome;
			$celulas = $celula->chamar($nome);
			require_once 'celula/visao/chamar.php' ;

		}

		public function lideresCelula(){

			$lideres = new \celula\modelo\celula();
			$lideres = $lideres->listarLideresCelula() ;

			require_once 'celula/visao/listarLideresCelula.php' ;

		}
    /*
		 * Relatorio de Célula por mês.
		 * */
		public function porMes($url){
			$ids = isset($url['post']['temasId']) ? $url['post']['temasId']: '';

			if ( $ids){
      foreach($ids as $id ){
				$t = new temaModelo();
				$t->id = $id;
			  $tem[] = $t->listarUm();
			}}
      //var_dump($tem);

      $temas = new temaModelo();
      $temas = $temas->listarTodos();

			$relatorio = new relatorioModelo();
			$relatorios = $relatorio->porMes($ids);
			//var_dump($relatorios);

			$rel = array();
			foreach($relatorios as $celula){
				$rel[$celula['celulaNome']][$celula['tId']] = $celula['tId'] ;
			}

			//var_dump($ids);
			//var_dump($rel);
			//die();
			require_once 'celula/visao/relatorioCelula/porMes.php' ;

		}

}
