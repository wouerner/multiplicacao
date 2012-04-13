<?php 

class statusCelular{

		  private $id ;
		  private $discipuloId;
		  private $tipoStatusCelular;

		  public function __get($prop){

					 return $this->$prop ;
		  
		  }

		  public function __set($prop, $valor){

					 $this->$prop = $valor ;
		  
		  }


			  public function salvarTipoStatusCelular(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "INSERT INTO TipoStatusCelular ( nome )
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


			  public function atualizar(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "UPDATE Discipulo SET 	nome = ? , telefone = ? , email = ? ,endereco = ? , nivel = ?, 
				  lider = ?, celula = ? ,  ativo = ?
				  WHERE id = ?
							  ";
			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->nome);
			  $stm->bindParam(2, $this->telefone);
			  $stm->bindParam(3, $this->email);
			  $stm->bindParam(4, $this->endereco);
			  $stm->bindParam(5, $this->nivel);
			  $stm->bindParam(6, $this->lider);
			  $stm->bindParam(7, $this->celula);
			  $stm->bindParam(8 , $this->ativo) ;
			  $stm->bindParam(9, $this->id);

			  $resposta = $stm->execute();

			  $erro = $stm->errorInfo();
			  //var_dump($erro);
			  //exit();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
			  
			  }



}
