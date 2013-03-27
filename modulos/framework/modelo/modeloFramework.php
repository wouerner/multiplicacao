<?php 

namespace framework\modelo ;

class modeloFramework{

	private  static $con = false ;

	function __construct(){}

	public static function criarConexao(){
					
		$options = array( \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',); 

		if (false === self::$con) {
    	self::$con = new \PDO(DSN, USER, PASSWD, $options);
  	}
  return self::$con;
	}

	public static function pegarConexao(){
		return self::criarConexao() ;
	
	}


}
