<?php

namespace statusCelular\modelo ;

class statusCelular{

		  private $id ;
		  private $discipuloId;
		  private $tipoStatusCelular;
		  private $dataInicio;
		  private $ativo;

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
			  $sql = "INSERT INTO StatusCelular ( discipuloId, tipoStatusCelular,dataInicio, ativo )
				  VALUES ( ? , ? , NOW(), 1 )";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->discipuloId);
			  $stm->bindParam(2, $this->tipoStatusCelular);

			  $resposta = $stm->execute();


			//atualiza para esse o status atual
			  $this->id = $pdo->lastInsertId();
			  $this->atualizarAtivo();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
		}

		public function atualizarAtivo(){
			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = 'UPDATE StatusCelular SET ativo =  0  WHERE id <> ? AND discipuloId = ? '
				 ;

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->id);
			  $stm->bindParam(2, $this->discipuloId);

			  $resposta = $stm->execute();
			//  var_dump($stm->errorInfo());

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
		}





			  public function atualizar(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "UPDATE StatusCelular SET 	tipoStatusCelular = ?
				  WHERE discipuloId = ?
							  ";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->tipoStatusCelular );
			  $stm->bindParam(2, $this->discipuloId );

			  $resposta = $stm->execute();

			  $erro = $stm->errorInfo();
			  //var_dump($erro);
			  //exit();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;

			  }

			  public function listarUm(){

				  $pdo = new \PDO (DSN,USER,PASSWD);

				  $sql = 'SELECT * FROM StatusCelular WHERE id = ?';

				  $stm = $pdo->prepare($sql);

				  $stm->bindParam(1, $this->id);

				  $stm->execute();

				  return $stm->fetch();

			  }
			  /*
				*Este metodo retorna todos os Status do discipulo ordenado por data.
				*
				* */

			  public function listarTodosStatus(){

				  $pdo = new \PDO (DSN,USER,PASSWD);

				  $sql = 'SELECT  discipuloId, dataInicio , nome , s.id AS statusId , ts.id AS tipoId
							FROM StatusCelular AS s , TipoStatusCelular AS ts
							WHERE
							s.discipuloId = ? AND ts.id = s.tipoStatusCelular ORDER BY s.dataInicio DESC';

				  $stm = $pdo->prepare($sql);

				  $stm->bindParam(1, $this->discipuloId);

				  $stm->execute();

				  $resposta = array();

					while($ob = $stm->fetchObject('\statusCelular\modelo\statusCelular')){
						$resposta[$ob->statusId] = $ob ;
					}
				  return $resposta;


			  }

			  public function getTipoStatusCelular(){
						 $tipoStatus = new \statusCelular\modelo\tipoStatusCelular();
						 $tipoStatus->id = $this->tipoStatusCelular ;
						 return $tipoStatus->listarUm();


			  }

			  public function getDataInicio(){
			  try
			  {
				  return  new \DateTime($this->dataInicio, new \DateTimeZone('America/Sao_Paulo'));
			  }
			  catch( \Exception $e )
				  {
				  echo 'Erro ao instanciar objeto.';
					echo $e->getMessage();
				  exit();
				  }

			  }



			  public function pegarStatusCelular(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "SELECT * FROM StatusCelular AS s, TipoStatusCelular
								WHERE  s.discipuloId = ? AND tipoStatusCelular = TipoStatusCelular.id and s.ativo=1
								ORDER BY s.dataInicio DESC";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->discipuloId);

			  $resposta = $stm->execute();


			  //fechar conexÃ£o
			  $pdo = null ;
			  //var_dump($this->discipuloId);
				//var_dump($stm->errorInfo());

			  return $stm->fetch();
	}

			  public function listarStatusCelularTodos(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
				$sql = "SELECT Discipulo.nome AS discipulo , TipoStatusCelular.nome AS status
								FROM Discipulo,StatusCelular, TipoStatusCelular
						 		WHERE Discipulo.id = StatusCelular.discipuloId And
								StatusCelular.tipoStatusCelular = TipoStatusCelular.id ORDER BY discipulo";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores

			  $resposta = $stm->execute();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $stm->fetchAll();
	}



				/**
					* Retorna os objetos de discipulos ultimo status dos discipulos
					*/
			  public function listarStatusCelularPorTipo(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);

			  $sql = 'SELECT d.*  ,sc.id AS idStatus, tpsc.nome AS tipoNome
				  FROM Discipulo AS d inner join StatusCelular AS sc
				  ON d.id = sc.discipuloId and d.ativo = 1 AND d.arquivo = 0
				INNER JOIN TipoStatusCelular AS tpsc ON sc.tipoStatusCelular = tpsc.id
WHERE 1
AND sc.ativo =1 AND sc.tipoStatusCelular = ?
';

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->tipoStatusCelular);

				$stm->execute();

				$resposta = array();

				while($ob = $stm->fetchObject('\discipulo\Modelo\Discipulo')){
					$resposta[$ob->id] = $ob ;
				}

			  $pdo = null ;

				return $resposta ;
	}

			  public function discipulosInativos(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);

			  $sql = 'SELECT d.*  ,sc.id AS idStatus, tpsc.nome AS tipoNome
				  FROM Discipulo AS d inner join StatusCelular AS sc
				  ON d.id = sc.discipuloId and d.ativo = 0 AND d.arquivo = 0
				INNER JOIN TipoStatusCelular AS tpsc ON sc.tipoStatusCelular = tpsc.id
WHERE 1
AND sc.ativo =1 AND sc.tipoStatusCelular = ?
';

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->tipoStatusCelular);

				$stm->execute();

				$resposta = array();

				while($ob = $stm->fetchObject('\discipulo\Modelo\Discipulo')){
					$resposta[$ob->id] = $ob ;
				}

			  $pdo = null ;

				return $resposta ;
	}

			  public function discipulosArquivo(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);

			  $sql = 'SELECT d.*  ,sc.id AS idStatus, tpsc.nome AS tipoNome
				  FROM Discipulo AS d inner join StatusCelular AS sc
				  ON d.id = sc.discipuloId and d.arquivo = 1
				INNER JOIN TipoStatusCelular AS tpsc ON sc.tipoStatusCelular = tpsc.id
WHERE 1
AND sc.ativo =1 AND sc.tipoStatusCelular = ?
';

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->tipoStatusCelular);

				$stm->execute();

				$resposta = array();

				while($ob = $stm->fetchObject('\discipulo\Modelo\Discipulo')){
					$resposta[$ob->id] = $ob ;
				}

			  $pdo = null ;

				return $resposta ;
	}

    public function  quantidadePorStatusCelular() {

        $pdo = new \PDO(DSN, USER, PASSWD);

        $sql = 'SELECT sc.id AS idStatus, tpsc.nome AS tipoNome, count( * ) AS total, sc.tipoStatusCelular
            FROM
            Discipulo 		AS d
            INNER JOIN
            StatusCelular	AS sc
            ON d.id = sc.discipuloId AND d.ativo = 1 and d.arquivo = 0  and sc.ativo = 1
            INNER JOIN
            TipoStatusCelular tpsc ON sc.tipoStatusCelular = tpsc.id
            WHERE 1
            AND sc.ativo = 1
            GROUP BY sc.tipoStatusCelular
            order by tpsc.ordem';

        $stm = $pdo->prepare($sql);

        $resposta = $stm->execute();

        $resposta = $stm->fetchAll();

        $pdo = null ;

        return $resposta;
    }

	public function pegarStatusCelularPorLider($lider){

			  $pdo = new \PDO(DSN, USER, PASSWD);
$sql = 'SELECT sc.id AS idStatus, tpsc.nome AS tipoNome, count( * ) AS total, sc.tipoStatusCelular
FROM
Discipulo 		AS d
INNER JOIN
StatusCelular	AS sc
ON d.id = sc.discipuloId
INNER JOIN
TipoStatusCelular tpsc ON sc.tipoStatusCelular = tpsc.id
WHERE 1
AND sc.ativo = 1
AND d.lider = ?
GROUP BY sc.tipoStatusCelular';

			  $stm = $pdo->prepare($sql);
				$stm->bindParam(1 , $lider);

			  $resposta = $stm->execute();

			  $resposta = $stm->fetchAll();

			  $pdo = null ;

			  return $resposta;


	}


			  public function excluir(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "DELETE FROM StatusCelular WHERE Id = ?";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->id);

			  $resposta = $stm->execute();

			  $pdo = null ;

			  return $resposta;
	}



}
