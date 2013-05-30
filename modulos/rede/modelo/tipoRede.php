<?php

namespace rede\modelo ;

use \framework\modelo\modeloFramework ; 
use \metas\modelo\metas as Metas; 

class  tipoRede extends modeloFramework {

	private $id ;
	private $nome ;
	private $erro ;


		  public function __get($prop){

					 return $this->$prop ;
		  
		  }

		  public function __set($prop, $valor){

					 $this->$prop = $valor ;
		  
		  }

			public function getMeta(){
				$meta = new Metas();
				$meta->tipoRedeId = $this->id;
				$meta = $meta::metaPorRede();			
				//var_dump($meta);
				return $meta[0] ;
			
			}

			  public function salvar(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "INSERT INTO TipoRede ( nome )
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


			  public function salvarTipoRedeDiscipulo(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "INSERT INTO TipoRedeTemDiscipulo ( ministerioId, discipuloId, funcaoId )
				  VALUES (?,?,?)";

			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->nome);
			  $stm->bindParam(2, $this->nome);
			  $stm->bindParam(3, $this->nome);

			  $resposta = $stm->execute();

			  //fechar conexÃ£o
			  $pdo = null ;

			  return $resposta;
	}

	public function listarTodos(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM TipoRede';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		$resposta = array();

		while($obj = $stm->fetchObject('\rede\modelo\tipoRede') ){
			$resposta[$obj->id] = $obj ;
		}

		return $resposta;

	}

    public  function totalDiscipulosPorRede(){
		
			  $pdo = self::pegarConexao() ;

				$sql =' 
								SELECT count(*) FROM Discipulo as d 
inner join Redes as r on d.id = r.discipuloId and d.ativo = 1
WHERE r.tipoRedeId = ? 
								';

			  //prepara sql
			  $stm = $pdo->prepare($sql);
				//var_dump($this);
				$id = $this->id ;

			  $stm->bindParam(1, $id);

			  $stm->execute();
			  $resposta = $stm->fetch();

			  $pdo = null ;

			  return $resposta[0];
		
		}	

	public function listarUm(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM TipoRede WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();

		return $stm->fetchObject();

	}

	public function listarCelulas(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Celula WHERE tipoRedeId = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();
		$resposta = array(); 

		while ( $obj = $stm->fetchObject('\celula\modelo\celula') ) {
			$resposta[$obj->id] = $obj ; 
		}

		return $resposta ; 
	}

	public function atualizar(){

	//abrir conexao com o banco
	$pdo = new \PDO(DSN, USER, PASSWD);
	//cria sql
	$sql = " UPDATE TipoRede SET 	nome = ? 
		WHERE id = ? ";
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

	public function excluir(){
	try {
		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'DELETE FROM TipoRede WHERE id = ?';

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
