<?php

namespace statusCelular\modelo ;

class  tipoStatusCelular{

	private $id ;
	private $nome ;
	private $descricao ;
	private $ordem ;
	private $cor ;
	private $erro ;


		  public function __get($prop){

					 return $this->$prop ;
		  
		  }

		  public function __set($prop, $valor){

					 $this->$prop = $valor ;
		  
		  }

			  public function salvar(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "INSERT INTO TipoStatusCelular ( nome, descricao, ordem, cor  )
				  VALUES ( ? , ? , ? , ? )";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->nome );
			  $stm->bindParam(2, $this->descricao );
			  $stm->bindParam(3, $this->ordem );
			  $stm->bindParam(4, $this->cor );

			  $resposta = $stm->execute();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
	}

	public function listarTodos(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM TipoStatusCelular ORDER BY ordem ';

		$stm = $pdo->prepare($sql);

		$stm->execute();
		
		$resposta = array();

		while ( $obj = $stm->fetchObject('\StatusCelular\Modelo\TipoStatusCelular') ) {
			$resposta[$obj->id] = $obj ; 
		}
		return $resposta;

	}

	public function listarUm(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM TipoStatusCelular WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();

		return $stm->fetchObject();

	}

	public function atualizar(){

	//abrir conexao com o banco
	$pdo = new \PDO(DSN, USER, PASSWD);
	//cria sql
	$sql = " UPDATE TipoStatusCelular SET 	nome = ? , descricao = ? ,  ordem = ? , cor = ?
		WHERE id = ? ";
	//prepara sql
	$stm = $pdo->prepare($sql);
	//trocar valores
	$stm->bindParam(1, $this->nome);
	$stm->bindParam(2, $this->descricao);
	$stm->bindParam(3, $this->ordem);
	$stm->bindParam(4, $this->cor);
	$stm->bindParam(5, $this->id);

	$resposta = $stm->execute();

	//fechar conexÃ£o
	$pdo = null ;

	return $resposta;
	
	}

	public function excluir(){
	try {
		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'DELETE FROM TipoStatusCelular WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);


		$resposta = $stm->execute();
		$erro = $stm->errorCode();
		 
		if ($erro != '0000'){

			 throw new \Exception ('Existe discípulos cadastrados') ;
		}
		}catch ( \Exception $e ) {
		
				  $this->erro= $e->getMessage();
	}

	}


}
