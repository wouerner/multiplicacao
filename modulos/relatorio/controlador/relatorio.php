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


} 
