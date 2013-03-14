<?php 

namespace relatorio\modelo; 

class discipulos{


			  function ordenar($a, $b) { return strnatcmp($a['lastname'], $b['lastname']); } 

	public function discipulosResumido($idadeMaxima,$idadeMinima,$sexo, $estadoCivil,$status , $celula , $rede=NULL , $ativo,$lider ){
		
			  $pdo = new \PDO(DSN,USER,PASSWD);

			  $s=$sexo;
			  $estado=$estadoCivil;
			  $st=$status;
			  $c=$celula;
				$r = $rede ;
				$l = $lider ;

			  if ($sexo == 'todos' ){
			  $sexo ='';
			  }else{
			  $sexo ='AND sexo = :sexo ';
			  }

			  if ($estadoCivil == 'todos' ){
			  $estadoCivil ='';
			  }else{
			  $estadoCivil='AND d.estadoCivilId = :estadoCivil ';
			  }

			  if ($status == 'todos' ){
			  $status ='';
			  }else{
			  $status='AND	StatusCelular.tipoStatusCelular = :status ';
			  }

			  if ($celula == 'todos' ){
			  $celula ='';
			  }else{
			  $celula ='AND d.celula = :celula' ;
			  }

			  if ($rede == 'todos' ){
			  $rede ='';
			  }else{
			  $rede ='AND  r.tipoRedeId = :rede ';
			  }

			  if ($ativo == 'todos' ){
			  $ativo ='';
			  }else if($ativo == 1 ){
			  $ativo ='AND d.ativo = 1' ;
				}else{
			  $ativo ='AND d.ativo = 0' ;
				}

			  if ($lider == 'todos' ){
			  $lider ='';
			  }else{
			  $lider ='AND  d.lider = :lider ';
			  }

				/*$sql = '
						 SELECT DISTINCT 
						 d.id, d.nome , d.dataNascimento, d.sexo, d.estadoCivilId, d.telefone, d.email, d.endereco, d.lider, d.celula
						 FROM 
						 Discipulo AS d,  StatusCelular , Redes AS r , TipoRede AS tpRede , FuncaoRede AS fRede
						 WHERE 
						 d.dataNascimento between :idadeMax and :idadeMin 
						 '.$sexo.' 
						 '.$estadoCivil.'
				  	 '.$status.'
				  	 '.$celula.'
				  	 '.$rede.'
				  		AND StatusCelular.discipuloId = d.id
							AND r.tipoRedeId = tpRede.id AND d.id = r.discipuloId 
							AND fRede.id = r.funcaoRedeId	
							AND StatusCelular.ativo = 1
							'.$ativo.'
							'.$lider.'
							
							ORDER BY d.nome';*/

					$sql='SELECT DISTINCT 
								d.id, d.nome , d.dataNascimento, d.sexo, d.estadoCivilId, d.telefone, d.email, d.endereco, d.lider, d.celula
								FROM 
									Discipulo AS d 
								left join 
									StatusCelular on StatusCelular.discipuloId = d.id and StatusCelular.ativo = 1 
								 left join  	
									Redes AS r on r.discipuloId = d.id 
								 left join 	
									TipoRede AS tpRede on tpRede.id = r.tipoRedeId 
								 left join
								 FuncaoRede AS fRede on r.funcaoRedeId = fRede.id
						 WHERE 
						 d.dataNascimento between :idadeMax and :idadeMin 
						 '.$sexo.' 
						 '.$estadoCivil.'
				  	 '.$status.'
				  	 '.$celula.'
				  	 '.$rede.'
						 '.$ativo.'
						 '.$lider.'
							ORDER BY d.nome
 						';

				//var_dump($lider);
				//var_dump($l);
				//echo $sql; exit();

			  $stm = $pdo->prepare($sql);

			  $stm->bindParam(':idadeMax',$idadeMaxima);
			  $stm->bindParam(':idadeMin',$idadeMinima);

			  if ($sexo != '' ) $stm->bindValue(':sexo',$s);
			  if ($estadoCivil != '' ) $stm->bindValue(':estadoCivil',$estado);
			  if ($status != '' ) $stm->bindValue(':status',$st);
			  if ($celula != '' ) $stm->bindValue(':celula',$c);
			  if ($rede != '' ) $stm->bindValue(':rede',$r);
			  if ($lider != '' ) $stm->bindValue(':lider',$l);

			  $stm->execute();

				$erro = $stm->errorInfo();
				//exit();

			  $res = array();

			  while ($s =$stm->fetchObject('\discipulo\Modelo\Discipulo')  ){
			  
			  		//$resposta[$s->id] =$s ;

					//$lider = $s->getLider();

			  		//$res[$s->lider]['lider'] = $lider->nome ;
			  		//$res[$s->lider][] = $s ;
			  		$res[$s->id] = $s ;
			  
			  }
			
				/*var_dump($sql);
				var_dump($res);
				exit();*/
			  //usort($res, function($a, $b) { return strnatcmp($a['lider'], $b['lider']); });

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

				//print("<pre>".var_dump($resposta)."</pre>"); exit();

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
			$sql = ' SELECT *
						FROM Discipulo
						WHERE month( dataNascimento ) = ? order by dayofmonth(dataNascimento)';

			$stm = $pdo->prepare($sql);
			$stm->bindParam( 1, $mes ) ;

			$stm->execute() ;	  

			$resposta = array();
			while ( $obj = $stm->fetchObject('\discipulo\Modelo\Discipulo') ){
				$resposta[$obj->id] = $obj ;

			}
			return $resposta ;
	
	}




}
