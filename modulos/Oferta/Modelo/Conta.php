<?php

namespace oferta\modelo;

class  conta implements \JsonSerializable {

	private $id ;
	private $nome ;


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
        $sql = "INSERT INTO Conta ( nome )
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

	public function listarTodos(){
		$pdo = new \PDO (DSN,USER,PASSWD);

		$sql = 'SELECT * FROM Conta';

		$stm = $pdo->prepare($sql);
		$stm->execute();

        $resposta = array();

        while ( $obj = $stm->fetchObject('\oferta\modelo\conta') ) {
            $resposta[] = $obj ;
        }

        return $resposta ;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'nome' => $this->nome
        ];
    }

	public function listarUm(){

		$pdo = new \PDO (DSN,USER,PASSWD);

		$sql = 'SELECT * FROM TipoOferta WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();

		return $stm->fetch();

	}

	public function atualizar(){

        //abrir conexao com o banco
        $pdo = new \PDO(DSN, USER, PASSWD);
        //cria sql
        $sql = " UPDATE Conta SET nome = ? WHERE id = ? ";
        //prepara sql
        $stm = $pdo->prepare($sql);
        //trocar valores
        $stm->bindParam(1, $this->nome);
        $stm->bindParam(2, $this->id);

        $resposta = $stm->execute();

        $pdo = null;

        return $resposta;
	}

	public function excluir(){
	try{
		$pdo = new \PDO (DSN,USER,PASSWD);

		$sql = 'DELETE FROM Conta WHERE id = ?';

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
