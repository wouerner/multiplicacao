<?php 
use discipulo\Modelo\Discipulo ;
namespace relatorio\controlador ;

class relatorio {

	public function discipulos(){

		$discipulos = new \discipulo\Modelo\Discipulo();
		$discipulos= $discipulos->listarTodosDiscipulos();
	
		require 'relatorio/visao/discipulos.php' ;	
	
	} 


	public function celulas(){

		$celulas = new \celula\modelo\celula();
		$celulas= $celulas->listarTodos();
	
		require 'relatorio/visao/celulas.php' ;	
	
	} 

	public function statusCelular(){

		$statusCelulares = new \statusCelular\modelo\statusCelular();
		$statusCelulares= $statusCelulares->listarStatusCelularTodos();
	
		require 'relatorio/visao/statusCelular.php' ;	
	
	} 

	public function statusCelularPorTipo($url){

		$statusCelulares = new \statusCelular\modelo\statusCelular();
		$statusCelulares->tipoStatusCelular = $url['2'] ;
		$statusCelulares= $statusCelulares->listarStatusCelularPorTipo();
		$status= $statusCelulares[0]['status'];
		require 'relatorio/visao/statusCelularTipo.php' ;	
	
	} 

	public function statusCelularIndex($url){

		$statusCelulares = new \statusCelular\modelo\tipoStatusCelular();
		$statusCelulares= $statusCelulares->listarTodos();

		require 'relatorio/visao/statusCelularIndex.php' ;	
	
	} 

	public function relatorioResumido($url){

		$post = $url['post'];
	if (empty($post)){
		$tipoStatusCelulares = new \statusCelular\modelo\tipoStatusCelular();
		$tipoStatusCelulares= $tipoStatusCelulares->listarTodos();

		$estadoCivies = new \discipulo\Modelo\estadoCivil();
		$estadoCivies = $estadoCivies->listarTodos();

		$celulas = new \celula\modelo\celula();
		$celulas = $celulas->listarTodos();

		$tipoRedes = new \rede\modelo\tipoRede();
		$tipoRedes = $tipoRedes->listarTodos();

		$lideres = new \discipulo\Modelo\Discipulo();
		$lideres = $lideres->listarTodosDiscipulos();

		require 'relatorio/visao/discipulosResumido.php' ;	
	}else{
	
		$idadeMinima = new \DateTime( "now" ,new \DateTimeZone('America/Sao_Paulo')) ;
		$idadeMaxima = new \DateTime( "now" ,new \DateTimeZone('America/Sao_Paulo')) ;

		$idadeMinima->sub(new \DateInterval('P'.$post['idadeMinima'].'Y') );
		$idadeMaxima->sub(new \DateInterval('P'.$post['idadeMaxima'].'Y') );

		$sexo = $post['sexo'];
		$estadoCivil = $post['estadoCivil'];
		$status = $post['tipoStatusCelular'];
		$celula = $post['celula'];
		$rede = $post['rede'];
		$ativo = $post['ativo'];
		$lider = $post['lider'];

		$relatorio = new \relatorio\modelo\discipulos();

		$relatorio = $relatorio->discipulosResumido($idadeMaxima->format('Y-m-d'), $idadeMinima->format('Y-m-d') ,$sexo,$estadoCivil,$status , $celula , $rede,$ativo , $lider);
		
		if ($sexo != 'todos'){	
			$sexo = ($post['sexo']=='m') ? "Masculino" : "Feminino";
		}
			
		if ($estadoCivil != 'todos'){
		$estadoCivil = new \discipulo\Modelo\estadoCivil();
		$estadoCivil->id = $post['estadoCivil'];
		$estadoCivil = $estadoCivil->listarUm();
		}

		if ($status != 'todos'){
		$status = new \statusCelular\modelo\tipoStatusCelular();
		$status->id = $post['tipoStatusCelular'];
		$status = $status->listarUm();
		}

		if ($celula != 'todos'){
		$celula = new \celula\modelo\celula();
		$celula->id = $post['celula'];
		$celula = $celula->listarUm();
		}

		if ($estadoCivil != 'todos'){
		$estadoCivil = new \discipulo\Modelo\estadoCivil();
		$estadoCivil->id = $post['estadoCivil'];
		$estadoCivil = $estadoCivil->listarUm();
		}

		if ($rede != 'todos'){
		$rede = new \rede\modelo\tipoRede();
		$rede->id = $post['rede'];
		$rede = $rede->listarUm();
		}

	//	$status = $post['tipoStatusCelular'];
	//	$celula = $post['celula'];
	//	$rede = $post['rede'];
	//var_dump($relatorio);
		//
		$total = count($relatorio);
		require 'relatorio/visao/discipulosResumidoRelatorio.php' ;	
	}
	
	} 

	public function liderComDiscipulos (){
			
		$relatorio = new \relatorio\modelo\discipulos();

		$relatorio = $relatorio->liderComDiscipulos();

//		var_dump($relatorio);
		
		require 'relatorio/visao/liderComDiscipulos.php' ;	

	}

	public function graficoPorStatusCelular (){
	
	
		$relatorio = new \relatorio\modelo\discipulos();
		$relatorio = $relatorio->graficoPorStatusCelular();		

		require 'relatorio/visao/graficoPorStatusCelular.php' ;	
	
	}


	public function graficoPorCelula ($url){
			  
			  
	if(empty($url['post']))	{

		$celulas = new \celula\modelo\celula();
		$celulas = $celulas->listarTodos();
		require 'relatorio/visao/graficoPorCelula.php' ;	
	}else {
		$celula = $url['post'];

		$celulas = new \celula\modelo\celula();

		$celulas->id = $celula['celula'];
		$nomeCelula = $celulas->listarUm();


		$celulas = $celulas->listarTodos();

		$relatorio = new \relatorio\modelo\discipulos();
		$relatorio = $relatorio->graficoPorCelula($celula['celula']);		



		require 'relatorio/visao/graficoPorCelula.php' ;	
	
	
	}
	
	}

	public function graficoPorEvento (){
	
	
		$relatorio = new \relatorio\modelo\discipulos();
		$relatorio = $relatorio->graficoPorEvento();		

		require 'relatorio/visao/graficoPorEvento.php' ;	
	
	}

	public function aniversariantes($url){
		$post = $url['post']	;

		if ( !empty($post) ) {	
		$relatorios = new \relatorio\modelo\discipulos();
		$relatorios = $relatorios->aniversarianteMes($post['data']);		

		require 'relatorio/visao/aniversariantes.php' ;	
		} else {
		require 'relatorio/visao/aniversarios.php' ;	
		
		}
	
	}

	public function relatorioCelula($url){
		if ($url['post']){

		$inicio = explode('/',$url['post']['inicio']);
		$inicio =$inicio[2]. '-' .$inicio[1].'-'.$inicio[0];
		$fim = explode('/',$url['post']['fim']);
		$fim = $fim[2].'-'.$fim[1].'-'.$fim[0];

		$relatorios = \celula\modelo\relatorioCelula::porData($inicio,$fim);
		}

		require 'relatorio/visao/relatorioCelula.php' ;	
	
	}

	public function relatorioCelulaEnvio($url){
		if ($url['post']){

		$inicio = explode('/',$url['post']['inicio']);
		$inicio =$inicio[2]. '-' .$inicio[1].'-'.$inicio[0].' '.$url['post']['tempoInicio'];
		$fim = explode('/',$url['post']['fim']);
		$fim = $fim[2].'-'.$fim[1].'-'.$fim[0].' '.$url['post']['tempoFim'] ;
		
		$relatorios = \celula\modelo\relatorioCelula::envioPorCelula($inicio,$fim);
		}

		require 'relatorio/visao/relatorioCelulaEnvio.php' ;	
	
	}

	public function relatorioCelulaEnvioPorTema($url){

		$tema = new \celula\modelo\temaRelatorioCelula() ;			
		//$temas = $tema->listarTodosAtivos();
		$temas = $tema->listarTodos();

		if ( $url['post'] ){

			$tema->id = $url['post']['temaId'];
			$tema = $tema->listarUm();

			$relatorio = new \celula\modelo\relatorioCelula() ;			
			$relatorio->temaRelatorioCelulaId = $url['post']['temaId'] ;			
			$relatorios = $relatorio->listarTodosPorTema() ;			
			$cont=0;
//			var_dump($relatorios);
		}

		require 'modulos/relatorio/visao/relatorioCelulaPorTema.php' ;	
	
	}


} 

