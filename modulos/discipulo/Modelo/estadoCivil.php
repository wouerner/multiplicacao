<?php

namespace discipulo\Modelo;

class estadoCivil{

	private $id ;
	private $nome ;
	private $erro ;

	public function __construct (){
	}

	public function __get($prop){
				  return $this->$prop;
	}
	
	public function __set($prop , $valor){
			  $this->$prop = $valor;
	
	}

	public function salvar(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "INSERT INTO EstadoCivil (nome  )
				  VALUES (?)";
			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->nome);

			  $resposta = $stm->execute();
				
			  $erro =  $stm->errorInfo();

			  $this->erro = $erro[0];
				
			  //fechar conexão
			  $pdo = null ;

			  return $resposta;
	
	}

	public function atualizar(){
		try {

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "UPDATE EstadoCivil SET 	nome = ?  
				  WHERE id = ? ";
			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->nome);
			  $stm->bindParam(2, $this->id);

			  $resposta = $stm->execute();
			  $erro = $stm->errorCode();

				var_dump($stm->errorInfo());


			  if ($erro != '0000'){

					throw new \Exception ('Não foi possivel atualizar') ;
				}

			} catch ( \Exception $e ) {
		
				$this->erro= $e->getMessage();
		
			}
		  //fechar conexÃ£o
		  $pdo = null ;

		  return $resposta;
	
	}
	/*
	 *
	 * */
	public function listarTodos(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM EstadoCivil';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		return $stm->fetchAll();

	}

	public function listarUm(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM EstadoCivil WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();

		

		$resposta =$stm->fetchObject('\discipulo\Modelo\estadoCivil');

		return $resposta ;

	}

	public function excluir(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'DELETE FROM EstadoCivil WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();

	}


}
