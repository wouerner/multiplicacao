<?php 

namespace relatorio\modelo; 

class discipulos{


			  function ordenar($a, $b) { return strnatcmp($a['lastname'], $b['lastname']); } 

	public function discipulosResumido($idadeMaxima,$idadeMinima,$sexo, $estadoCivil,$status){
		
			  $pdo = new \PDO(DSN,USER,PASSWD);

			  $s=$sexo;
			  $estado=$estadoCivil;
			  $st=$status;

			  if ($sexo == 'todos' ){
			  $sexo ='';
			  }else{
			  $sexo ='AND sexo = :sexo ';
			  }

			  if ($estadoCivil == 'todos' ){
			  $estadoCivil ='';
			  }else{
			  $estadoCivil='AND Discipulo.estadoCivilId = :estadoCivil ';
			  }

			  if ($status == 'todos' ){
			  $status ='';
			  }else{
			  $status='AND	StatusCelular.tipoStatusCelular = :status ';
			  }

			  $sql = 'SELECT DISTINCT 
						 d.id, d.nome , d.dataNascimento, d.sexo, d.estadoCivilId, d.telefone, d.email, d.endereco, d.lider, d.celula, 
						 StatusCelular.id as StatusId    
						 FROM 
						 Discipulo AS d,  StatusCelular
						 WHERE 
						 d.dataNascimento between :idadeMax and :idadeMin 
						 '.$sexo.' 
						 '.$estadoCivil.'
				  		 '.$status.'
				  		AND StatusCelular.discipuloId = d.id ORDER BY d.nome';


			  $stm = $pdo->prepare($sql);

			  $stm->bindParam(':idadeMax',$idadeMaxima);
			  $stm->bindParam(':idadeMin',$idadeMinima);

			  if ($sexo != '' ) $stm->bindValue(':sexo',$s);
			  if ($estadoCivil != '' ) $stm->bindValue(':estadoCivil',$estado);
			  if ($status != '' ) $stm->bindValue(':status',$st);

			  $stm->execute();

			  //var_dump($stm->fetchAll());

			  $res = array();

			  while ($s =$stm->fetchObject('\discipulo\Modelo\Discipulo')  ){
			  
			  		//$resposta[$s->id] =$s ;

					$lider = $s->getLider();

			  		$res[$s->lider]['lider'] = $lider->nome ;
			  		$res[$s->lider][] = $s ;
			  
			  }
			
						 // sort alphabetically by name usort($data, 'compare_lastname');


				//var_dump($resposta);
			  //asort($res);
			  usort($res, function($a, $b) { return strnatcmp($a['lider'], $b['lider']); });
				//var_dump($res);

				return $res;	
	
	}


	public function liderComDiscipulos(){
			  $pdo = new \PDO(DSN,USER,PASSWD);

			  $sql = 'SELECT DISTINCT l.id AS liderId, l.nome AS nomeLider, l.endereco, l.telefone, l.dataNascimento , d.id AS discipuloId, d.nome AS nomeDiscipulo
							FROM Discipulo AS d, Discipulo AS l
							WHERE d.lider = l.id
							ORDER BY l.nome';
	
				$stm = $pdo->prepare($sql);

				$stm->execute();	  

				$resposta	= array();
				while($lider = $stm->fetchObject('\discipulo\Modelo\Discipulo')){
					$resposta[$lider->liderId]['lider'] =   $lider->nomeLider; 	
					$resposta[$lider->liderId][$lider->discipuloId] = $lider; 	

				
				}

				//var_dump($resposta);

				return $resposta;
	
	}

	public function graficoPorStatusCelular(){
			$pdo = new \PDO(DSN,USER,PASSWD);
			$sql = 'SELECT * , count( s.id ) AS quantidade
FROM StatusCelular AS s, TipoStatusCelular
WHERE s.tipoStatusCelular = TipoStatusCelular.id
GROUP BY tipoStatusCelular';
			$stm = $pdo->prepare($sql);

			$stm->execute();	  


			return $stm->fetchAll();
	}

	public function graficoPorEvento(){
			$pdo = new \PDO(DSN,USER,PASSWD);
			$sql = '
					 SELECT e.nome AS nomeEvento, count( ev.discipuloId ) AS total
					 FROM Evento AS e
					 LEFT JOIN DiscipuloTemEvento AS ev ON e.id = ev.eventoId
					 GROUP BY e.id
					 ';

			$stm = $pdo->prepare($sql);

			$stm->execute();	  


			return $stm->fetchAll();
	}


	public function graficoPorCelula($celulaId){
			$pdo = new \PDO(DSN,USER,PASSWD);
			$sql = 'SELECT TipoStatusCelular.nome AS nome  , COUNT(*) AS total
FROM 
 TipoStatusCelular, StatusCelular, Discipulo 
WHERE 

Discipulo.id = StatusCelular.discipuloId 

AND StatusCelular.tipoStatusCelular=TipoStatusCelular.id

AND Discipulo.celula = ?
GROUP BY TipoStatusCelular

ORDER BY TipoStatusCelular.nome';

			$stm = $pdo->prepare($sql);
			$stm->bindParam(1,$celulaId);

			$stm->execute();	  


			return $stm->fetchAll();
	}

	public function aniversarianteMes(  $mes ){
			$pdo = new \PDO(DSN,USER,PASSWD);
			$sql = ' SELECT nome, dataNascimento
						FROM Discipulo
						WHERE month( dataNascimento ) = ?';

			$stm = $pdo->prepare($sql);
			$stm->bindParam( 1, $mes ) ;

			$stm->execute() ;	  

			return $stm->fetchAll() ;
	
	}




}
