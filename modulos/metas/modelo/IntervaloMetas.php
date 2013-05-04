<?php
namespace metas\modelo ;
use framework\modelo\modeloFramework;

class  intervaloMetas extends modeloFramework{

	private $id ;
	private $nome ;
	private $dataInicio ;
	private $dataFim ;


		  public function __get($prop){

					 return $this->$prop ;
		  
		  }

		  public function __set($prop, $valor){

					 $this->$prop = $valor ;
		  
		  }

		 public function salvar(){

			  /*$pdo = self::pegarConexao() ;
			  //cria sql
			  $sql = "INSERT INTO IntervaloMetas ( nome, dataInicio, dataFim )
				  VALUES (?,?,?)";

			  $stm = $pdo->prepare($sql);
			  $stm->bindParam(1, $this->nome);
			  $stm->bindParam(2, $this->dataInicio);
			  $stm->bindParam(3, $this->dataFim);

			  $resposta = $stm->execute();

			  $pdo = null ;

				return $resposta;*/
						 self::insert('IntervaloMetas','data');
						 //echo 'oi';
						 die();


	}

	public function setDataInicio(){} 
	public function setDataFim(){} 

	public function listarTodos(){

	  $pdo = self::pegarConexao() ;

		$sql = 'SELECT * FROM TipoEquipe ORDER BY nome ';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		$resposta = array();	
		while ( $obj = $stm->fetchObject('\encontroComDeus\modelo\tipoEquipe') ){
			$resposta[$obj->id] = $obj ; 	
		}
		return $resposta ; 

	}

	public function listarUm(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Funcao WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();

		return $stm->fetch();

	}

	public function atualizarFuncao(){

	//abrir conexao com o banco
	$pdo = new \PDO(DSN, USER, PASSWD);
	//cria sql
	$sql = " UPDATE Funcao SET 	nome = ? 
		WHERE id = ? ";
	//prepara sql
	$stm = $pdo->prepare($sql);
	//trocar valores
	$stm->bindParam(1, $this->nome);
	$stm->bindParam(2, $this->id);

	$resposta = $stm->execute();

	//fechar conexÃ£o
	$pdo = null ;

	return $resposta;
	
	}

	public function excluir(){
		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'DELETE FROM TipoEquipe WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		 $stm->execute();

	}


}
