<?php

namespace admissao\modelo;

class admissao{
	
		  private $discipuloId;
		  private $tipoAdmissao;


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
			  $sql = "INSERT INTO Admissao (discipuloId , tipoAdmissao )
				  		VALUES (?,?)";
			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->discipuloId);
			  $stm->bindParam(2, $this->tipoAdmissao);

			  $resposta = $stm->execute();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
			  
		  }

		  public function salvarDiscipuloEvento($discipuloId, $tipoAdmissao){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "INSERT INTO DiscipuloTemEvento (discipuloId, eventoId )
				  		VALUES (?,?)";
			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $discipuloId);
			  $stm->bindParam(2, $tipoAdmissao);

			  $resposta = $stm->execute();


			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
			  
		  }

		  public function listarTodos(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Evento';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		return $stm->fetchAll();

	}

	/* Exclui um evento associado a um discipulo.
	 *
	 *
	 *
	 */
	public function excluir(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'DELETE FROM DiscipuloTemEvento WHERE discipuloId = ? AND eventoId = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->discipuloId);
		$stm->bindParam(2, $this->eventoId);

		$stm->execute();

	}
	
	/*Lista apenas um Disicpulo
	*/

	public function listarUm(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Admissao, TipoAdmissao WHERE discipuloId = ? AND Admissao.tipoAdmissao = TipoAdmissao.id Limit 1';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->discipuloId);

		$stm->execute();

		return $stm->fetch();

	}

	public function atualizar(){

	//abrir conexao com o banco
	$pdo = new \PDO(DSN, USER, PASSWD);
	//cria sql
	$sql = "UPDATE Admissao SET 	tipoAdmissao = ?	WHERE discipuloId = ?
					";
	//prepara sql
	$stm = $pdo->prepare($sql);
	//trocar valores
	$stm->bindParam(1, $this->tipoAdmissao);
	$stm->bindParam(2, $this->discipuloId);


	$resposta = $stm->execute();

	var_dump($stm->errorInfo());

	//fechar conexÃ£o
	$pdo = null ;

	return $resposta;
	
	}
		

	public function listarTodosDiscipulo($url){

		$pdo = new \PDO(DSN, USER, PASSWD);	  
		
		$sql = '
		SELECT DISTINCT id , nome
		FROM DiscipuloTemEvento , Evento
		WHERE DiscipuloTemEvento.discipuloId = ? AND Evento.id = DiscipuloTemEvento.eventoId
		' ;

		$stm = $pdo->prepare($sql);

		
		$stm->bindParam(1, $url);

		$stm->execute() ; 

		return $stm->fetchAll();
	
	}


}


