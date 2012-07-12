<?php 

namespace rede\modelo ;

class rede{

		  private $tipoRedeId ;
		  private $discipuloId ;
		  private $funcaoRedeId ;

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
			  $sql = "INSERT INTO  Redes ( tipoRedeId, discipuloId, funcaoRedeId)

				  VALUES (?,?,?)";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->tipoRedeId);
			  $stm->bindParam(2, $this->discipuloId);
			  $stm->bindParam(3, $this->funcaoRedeId);
			
			  $resposta = $stm->execute();
				
			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
	}

			  public function atualizar(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "UPDATE Redes SET 	tipoRedeId = ? , funcaoRedeId = ?  
				  WHERE discipuloId = ?
							  ";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->tipoRedeId );
			  $stm->bindParam(2, $this->funcaoRedeId );
			  $stm->bindParam(3, $this->discipuloId );

			  $resposta = $stm->execute();

			  $erro = $stm->errorInfo();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
			  
			  }

			  public function pegarRedeDiscipulo(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = 'SELECT
 tpRede.nome AS tipoRede, 
           tpRede.id AS tpRedeId, fRede.id AS funcaoId, fRede.nome AS funcaoRede
	
						FROM Redes AS r, TipoRede AS tpRede, FuncaoRede AS fRede

							WHERE r.discipuloId = ? and tpRede.id = r.tipoRedeId and r.funcaoRedeid = fRede.id
							';

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->discipuloId);


			  $stm->execute();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $stm->fetchAll();
				}

			  public function excluir(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "DELETE FROM Redes WHERE discipuloId = ?  
				  AND tipoRede = ?
							  ";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->discipuloId );
			  $stm->bindParam(2, $this->tipoRede );

			  $resposta = $stm->execute();

			  $erro = $stm->errorInfo();
	
			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
			  
			  }

			  public function listarUm(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "SELECT FuncaoRede.id AS funcaoId ,FuncaoRede.nome AS funcaoNome, TipoRede.id AS tipoId, TipoRede.nome AS tipoNome  FROM Redes, TipoRede, FuncaoRede   
						 WHERE Redes.DiscipuloId = ? And Redes.tipoRedeId = TipoRede.id AND Redes.FuncaoRedeId = FuncaoRede.id LIMIT 1";


			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->discipuloId );

			  $resposta = $stm->execute();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $stm->fetch();
	}



		  



}
