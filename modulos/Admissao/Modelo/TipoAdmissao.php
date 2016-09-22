<?php

namespace Admissao\Modelo;

class TipoAdmissao{

		  private $id;
		  private $nome;
		  private $erro;


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
			  $sql = "INSERT INTO TipoAdmissao (nome )
				  		VALUES (?)";
			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->nome);

			  $resposta = $stm->execute();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;

		  }

		  public function salvarDiscipuloTipoAdmissao($discipuloId, $admissaoId){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "INSERT INTO DiscipuloTemTipoAdmissao (discipuloId, admissaoId )
				  		VALUES (?,?)";
			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $discipuloId);
			  $stm->bindParam(2, $admissaoId);

			  $resposta = $stm->execute();

			  var_dump($stm->errorInfo());

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;

		  }

		public function listarTodos(){

		$pdo = new \PDO (DSN,USER,PASSWD);

		$sql = 'SELECT * FROM TipoAdmissao';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		return $stm->fetchAll();

	}

	public function excluir(){

		try{
		$pdo = new \PDO (DSN,USER,PASSWD);

		$sql = 'DELETE FROM TipoAdmissao WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$resposta = $stm->execute();
		$erro = $stm->errorCode();

		if ($erro != '0000'){

			 throw new \Exception ('Existe discípulos cadastrados nesse admissao') ;
		}
		}catch ( \Exception $e ) {

				  $this->erro= $e->getMessage();
	}
	}

	/* Exclui um admissao associado a um discipulo.
	 *
	 *
	 *
	 */
	public function excluirParticipacao(){

		$pdo = new \PDO (DSN,USER,PASSWD);

		$sql = 'DELETE FROM DiscipuloTemTipoAdmissao WHERE discipuloId = ? AND admissaoId = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->discipuloId);
		$stm->bindParam(1, $this->admissaoId);

		$stm->execute();

	}


	public function listarUm(){

		$pdo = new \PDO (DSN,USER,PASSWD);

		$sql = 'SELECT * FROM TipoAdmissao WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();

		return $stm->fetch();

	}

	public function atualizar(){

	//abrir conexao com o banco
	$pdo = new \PDO(DSN, USER, PASSWD);
	//cria sql
	$sql = "UPDATE TipoAdmissao SET 	nome = ?	WHERE id = ?
					";
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


	public function listarTodosDiscipulo($url){

		$pdo = new \PDO(DSN, USER, PASSWD);

		$sql = '
		SELECT DISTINCT id , nome
		FROM DiscipuloTemTipoAdmissao , TipoAdmissao
		WHERE DiscipuloTemTipoAdmissao.discipuloId = ? AND TipoAdmissao.id = DiscipuloTemTipoAdmissao.admissaoId
		' ;

		$stm = $pdo->prepare($sql);


		$stm->bindParam(1, $url);

		$stm->execute() ;


		return $stm->fetchAll();

	}


}


