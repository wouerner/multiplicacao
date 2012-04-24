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

} 
