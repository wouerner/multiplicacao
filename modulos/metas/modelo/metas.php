<?php 

namespace metas\modelo ;
use \framework\modelo\modeloFramework ; 

class metas extends modeloFramework{

  private $id ;
  private $quantidade ;
  private $discipuloId ;
  private $intervaloMetasId ;

  public function __get($prop){

		 return $this->$prop ;
  }

  public function __set($prop, $valor){

		 $this->$prop = $valor ;
		  
  }
  public function salvar(){

			  self::insert($this) ;
	}

			  public function atualizar(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "UPDATE MinisterioTemDiscipulo SET 	 ministerioId= ?  , funcaoId = ?
				  WHERE discipuloId = ?
							  ";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->ministerioId );
			  $stm->bindParam(2, $this->funcaoId );
			  $stm->bindParam(3, $this->discipuloId );

			  $resposta = $stm->execute();

			  $erro = $stm->errorInfo();
			  //var_dump($erro);
			  //exit();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
			  
			  }

			  public function listarTodos(){

			  $pdo = self::pegarConexao() ;

			  $sql = 'SELECT * 
						 FROM EncontroComDeus 
						 ORDER BY nome ' ;

			  $stm = $pdo->prepare($sql);

			  $resposta = $stm->execute();

			  $pdo = null ;
				$resposta = array();

				while ( $obj = $stm->fetchObject (get_class($this))  ) {
					$resposta[$obj->id] = $obj ;	
				}

			  return $resposta ;
				}

			  public function listarUm(){

			  $pdo = self::pegarConexao() ;

			  $sql = 'SELECT * 
								FROM Metas
								WHERE discipuloId = ?
						  ' ;

			  $stm = $pdo->prepare($sql);
			  $stm->bindParam(1, $this->discipuloId ) ;

			  $stm->execute();

			  $pdo = null ;
				//var_dump($stm->errorInfo());
			  return $stm->fetchObject() ;
				}


			  public function excluir(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "DELETE FROM EncontroComDeus WHERE id = ?  
							  ";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->id );

			  $resposta = $stm->execute();

			  $erro = $stm->errorInfo();
	
			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
			  
			  }

			  public function listarStatusCelularTodos(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "SELECT Discipulo.nome AS discipulo , TipoStatusCelular.nome AS status FROM Discipulo,StatusCelular, TipoStatusCelular  
						 WHERE Discipulo.id = StatusCelular.discipuloId And StatusCelular.tipoOferta = TipoStatusCelular.id ORDER BY discipulo";


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
Discipulo.id = StatusCelular.discipuloId AND TipoStatusCelular.id = ?  AND TipoStatusCelular.id = StatusCelular.tipoOferta" ; 


			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  //
			  $stm->bindParam(1, $this->tipoOferta);

			  $resposta = $stm->execute();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $stm->fetchAll();
	}

		  



}
