<?php 

namespace encontroComDeus\modelo ;
use \framework\modelo\modeloFramework ; 
class equipe extends modeloFramework{

  private $id ;
  private $encontroComDeusId ;
  private $tipoEquipeId ;
  private $discipuloId ;

  public function __get($prop){

		 return $this->$prop ;
  }

  public function __set($prop, $valor){

		 $this->$prop = $valor ;
		  
  }
  public function salvarMuitos($ids){

	  $pdo = self::pegarConexao() ;
	  $sql = "INSERT INTO  Equipe ( encontroComDeusId, tipoEquipeId, discipuloId )
				  			VALUES (?,?,?)";

	  $stm = $pdo->prepare($sql);

		foreach ($ids as $id ) {

	  $stm->bindParam(1, $this->encontroComDeusId) ;
	  $stm->bindParam(2, $this->tipoEquipeId) ;
	  $stm->bindParam(3, $id ) ;
			
	  $stm->execute();

		}
		
		$this->id = $pdo->lastInsertId();
	  $pdo = null ;

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

			  public function listarEquipe(){

			  $pdo = self::pegarConexao() ;

			  $sql = 'SELECT * 
								FROM Discipulo as d inner join Equipe AS e on d.id = e.discipuloId
								WHERE e.tipo
						 ORDER BY d.nome ' ;

			  $stm = $pdo->prepare($sql);
				$stm->bindParam(1, );
			  $resposta = $stm->execute();

			  $pdo = null ;
				$resposta = array();

				while ( $obj = $stm->fetchObject ('\discipulo\Modelo\Discipulo')  ) {
					$resposta[$obj->id] = $obj ;	
				}

			  return $resposta ;
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
