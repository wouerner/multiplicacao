<?php 

namespace statusCelular\modelo ;

class statusCelular{

		  private $id ;
		  private $discipuloId;
		  private $tipoStatusCelular;
		  private $dataInicio;

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
			  $sql = "INSERT INTO StatusCelular ( discipuloId, tipoStatusCelular,dataInicio )
				  VALUES ( ? , ? , CURDATE() )";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->discipuloId);
			  $stm->bindParam(2, $this->tipoStatusCelular);

			  //var_dump($stm->errorInfo());
				//exit();

			  $resposta = $stm->execute();

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
			  var_dump($erro);
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

				  $sql = 'SELECT discipuloId, dataInicio , nome , s.id AS statusId 
							FROM StatusCelular AS s , TipoStatusCelular AS ts 
							WHERE 
							s.discipuloId = ? AND ts.id = s.tipoStatusCelular ORDER BY dataInicio';

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
			  $sql = "SELECT * FROM StatusCelular, TipoStatusCelular WHERE  discipuloId = ? AND tipoStatusCelular = TipoStatusCelular.id ";

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
			  $sql = "SELECT Discipulo.nome AS discipulo , TipoStatusCelular.nome AS status FROM Discipulo,StatusCelular, TipoStatusCelular  
						 WHERE Discipulo.id = StatusCelular.discipuloId And StatusCelular.tipoStatusCelular = TipoStatusCelular.id ORDER BY discipulo";


			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores

			  $resposta = $stm->execute();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $stm->fetchAll();
	}


			  public function listarStatusCelularPorTipo(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "SELECT Discipulo.nome AS discipulo , TipoStatusCelular.nome AS status 
 FROM Discipulo,StatusCelular, TipoStatusCelular  WHERE 
 Discipulo.id = StatusCelular.discipuloId AND TipoStatusCelular.id = ?  AND TipoStatusCelular.id = StatusCelular.tipoStatusCelular
 						ORDER BY discipulo" ; 


			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  //
			  $stm->bindParam(1, $this->tipoStatusCelular);

			  $resposta = $stm->execute();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $stm->fetchAll();
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
