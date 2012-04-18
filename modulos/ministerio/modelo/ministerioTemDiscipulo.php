<?php 

namespace ministerio\modelo ;

class ministerioTemDiscipulo{

		  private $ministerioId ;
		  private $discipuloId ;
		  private $funcaoId ;

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
			  $sql = "INSERT INTO  MinisterioTemDiscipulo ( ministerioId, discipuloId, funcaoId)

				  VALUES (?,?,?)";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->ministerioId);
			  $stm->bindParam(2, $this->discipuloId);
			  $stm->bindParam(3, $this->funcaoId);
			
			  $resposta = $stm->execute();

				
			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
	}

			  public function atualizar(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "UPDATE StatusCelular SET 	tipoOferta = ?  
				  WHERE discipuloId = ?
							  ";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->tipoOferta );
			  $stm->bindParam(2, $this->discipuloId );

			  $resposta = $stm->execute();

			  $erro = $stm->errorInfo();
			  //var_dump($erro);
			  //exit();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
			  
			  }

			  public function pegarMinisterioDiscipulo(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "SELECT m.nome AS ministerio , f.nome AS funcao, discipuloId, ministerioId FROM Ministerio AS m , MinisterioTemDiscipulo, Funcao AS f 
						 WHERE m.id = MinisterioTemDiscipulo.ministerioId AND f.id = MinisterioTemDiscipulo.funcaoId AND MinisterioTemDiscipulo.discipuloId = ? ";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->discipuloId);

			  $resposta = $stm->execute();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $stm->fetchAll();
				}

			  public function excluir(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "DELETE FROM MinisterioTemDiscipulo WHERE discipuloId = ?  
				  AND ministerioId = ?
							  ";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->discipuloId );
			  $stm->bindParam(2, $this->ministerioId );

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
