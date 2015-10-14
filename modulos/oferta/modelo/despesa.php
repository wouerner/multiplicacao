<?php

namespace oferta\modelo;

class  despesa implements \JsonSerializable {

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
        $sql = "INSERT INTO Despesas ( descricao, pago, data, contaId, valor )
          VALUES (?,?,?,?,?)";

        //prepara sql
        $stm = $pdo->prepare($sql);
        //trocar valores
        $stm->bindParam(1, $this->descricao);
        $stm->bindParam(2, $this->pago);
        $stm->bindParam(3, $this->data);
        $stm->bindParam(4, $this->contaId);
        $stm->bindParam(5, $this->valor);

        $resposta = $stm->execute();
        //fechar conexÃ£o
        $pdo = null ;

        return $resposta;
    }

	public function listarTodos(){
		$pdo = new \PDO (DSN,USER,PASSWD);

		$sql = 'SELECT * FROM Despesas';

		$stm = $pdo->prepare($sql);
		$stm->execute();

        $resposta = array();

        while ( $obj = $stm->fetchObject('\oferta\modelo\despesa') ) {
            $resposta[] = $obj;
        }

        return $resposta ;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao,
            'data' => $this->data,
            'pago' => $this->pago ? true: false,
            'valor' => $this->valor,
            'contaId' => $this->conta()
        ];
    }

	public function conta() {
		$pdo = new \PDO (DSN,USER,PASSWD);

		$sql = 'SELECT * FROM Conta WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->contaId);

		$stm->execute();

        $resposta = array();

        while ( $obj = $stm->fetchObject('\oferta\modelo\conta') ) {
            $resposta = $obj;
        }

        return $resposta ;
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
        $sql = " UPDATE Despesas SET
            descricao = ?,
            pago = ?,
            data = ?,
            contaId = ?,
            valor = ?
            WHERE id = ? ";
        //prepara sql
        $stm = $pdo->prepare($sql);
        //trocar valores
        $stm->bindParam(1, $this->descricao);
        $stm->bindParam(2, $this->pago);
        $stm->bindParam(3, $this->data);
        $stm->bindParam(4, $this->contaId);
        $stm->bindParam(5, $this->valor);
        $stm->bindParam(6, $this->id);

        $resposta = $stm->execute();

        $pdo = null;

        return $resposta;
	}

	public function excluir(){
	try{
		$pdo = new \PDO (DSN,USER,PASSWD);

		$sql = 'DELETE FROM Despesas WHERE id = ?';

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

    public static function valorTotal () {

        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT sum(valor) as total FROM Despesas';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ( $obj = $stm->fetchObject('\oferta\modelo\conta') ) {
            $resposta = $obj;
        }

        return $resposta ;
    }
}
