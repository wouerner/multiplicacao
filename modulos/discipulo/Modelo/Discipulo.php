<?php
namespace discipulo\Modelo;
class Discipulo{

	private $id ;
	private $nome ;
	private $alcunha ;
	private $dataNascimento ;
	private $sexo = 'm' ; // padrão da classe é sexo masculino
	private $estadoCivilId ;
	private $ativo ;
	private $telefone ;
	private $email ;
	private $endereco ;
	private $nivel ;
	private $lider ;
	private $celula ;
	private $senha ;
	private $statusCelular ;
	private $admissao ;
	private $erro ;
	private $rede;

	public function __construct (){
	}

	public function __get($prop){
		if ($prop == 'dataNascimento'  ){  
				return $this->getDataNascimento();

		}else{
				  return $this->$prop;
		}
	
	}
	
	public function __set($prop , $valor){
			  $this->$prop = $valor;
	
	}

	public function getNomeAbreviado(){
			  $nome = explode(' ',$this->nome	) ;
			  $nome = $nome[0].' '.$nome[count($nome)-1]; 
			  return $nome ;
	}

	public function getNome(){
			  return  $this->nome ? $this->nome : $this->alcunha ;
	}

	public function setDataNascimento($valor){
	try
	{

		$this->dataNascimento = \DateTime::createFromFormat('d/m/Y',$valor,new \DateTimeZone('America/Sao_Paulo'));

	}
	catch( \Exception $e )
		{
 		echo 'Erro ao instanciar objeto.';
		 echo $e->getMessage();
 		exit();
		}	
	
	}


	public function getDataNascimento(){
			  try
			  {
				  $this->dataNascimento = new \DateTime($this->dataNascimento, new \DateTimeZone('America/Sao_Paulo'));
				  return $this->dataNascimento;
			  }
			  catch( \Exception $e )
				  {
				  echo 'Erro ao instanciar objeto.';
					echo $e->getMessage();
				  exit();
				}	
	}


	/*Pega a célula que o discipulo participa.
	 *
	 *
	 * */
	public function getCelula(){
		$celula = new \celula\modelo\celula();
		$celula->id = $this->celula;
		$this->celula = $celula->listarUm();
		return $this->celula	;
	
	}


	/*
	 *Listar todos os eventos do discipulo
	 *
	 * */
	public function getEventos(){
		$evento = new \evento\modelo\evento();
		$evento = $evento->listarTodosDiscipulo($this->id);

		return $evento	;
	
	}

	public function getEstatoCivil(){
		$estadoCivil = new estadoCivil();
		$estadoCivil->id = $this->estadoCivilId;
		$estadoCivil = $estadoCivil->listarUm();

		return $estadoCivil	;
	
	}

	public function getLider(){
		$lider = new Discipulo();
		$lider->id = $this->lider;
		$lider = $lider->listarUm();
		return $lider	;
	
	}

	public function getStatusCelular(){
		$status = new \statusCelular\modelo\statusCelular();
		$status->discipuloId = $this->id;
		$status = $status->pegarStatusCelular();
		return $status	;
	
	}

	public function getAdmissao(){
		$admissao = new \admissao\modelo\admissao();
		$admissao->discipuloId = $this->id;
		$admissao=  $admissao->listarUm();
		return $admissao	;
	
	}


	public function getRede(){
		$rede = new \rede\modelo\rede();
		$rede->discipuloId = $this->id;
		$rede =  $rede->pegarRedeDiscipulo();
		return $rede ;
	
	}

	public function getMinisterio(){
		$ministerio = new \ministerio\modelo\ministerioTemDiscipulo();
		$ministerio->discipuloId = $this->id;
		$ministerio =  $ministerio->pegarMinisterioDiscipulo();
		return $ministerio ;
	
	}



	public function salvar(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "INSERT INTO Discipulo (
							  nome, telefone, email,endereco, nivel, 
							  lider, celula,  senha, alcunha
							  )
				  VALUES (?,?,?,?,?,?,?,?,?)";
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
			  $stm->bindParam(8, md5($this->senha));
			  $stm->bindParam(9, $this->alcunha);

			  $resposta = $stm->execute();
				
			  $this->id = $pdo->lastInsertId();

			  $erro =  $stm->errorInfo();

			  $this->erro = $erro[0];

			  //fechar conexão
			  $pdo = null ;

			  return $resposta;
	
	}

	public function salvarCompleto(){

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "INSERT INTO Discipulo (
							  nome, ativo, datanascimento, sexo, estadoCivilId, telefone, email,endereco,  
							  lider, celula,  senha, alcunha
							  )
				  VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->nome);
			  $stm->bindParam(2, $this->ativo);
			  $stm->bindParam(3, $this->dataNascimento->format('Y-m-d') );
			  $stm->bindParam(4, $this->sexo);
			  $stm->bindParam(5, $this->estadoCivilId);
			  $stm->bindParam(6, $this->telefone);
			  $stm->bindParam(7, $this->email);
			  $stm->bindParam(8, $this->endereco);
			  $stm->bindParam(9, $this->lider);
			  $stm->bindParam(10, $this->celula);
			  $stm->bindParam(11, md5($this->senha));
			  $stm->bindParam(12, $this->alcunha);

			  $resposta = $stm->execute();
				
			  $this->id = $pdo->lastInsertId();

			  $erro =  $stm->errorInfo();

			  $this->erro = $erro[0];


			  //fechar conexão
			  $pdo = null ;

			  return $resposta;
	
	}

	public function emailUnico(){

			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "SELECT email FROM Discipulo WHERE email = ?";
			  //prepara sql
			  $stm = $pdo->prepare($sql);
			  //trocar valores
			  $stm->bindParam(1, $this->email);

			  $stm->execute();

			  if ($stm->fetch() == false){
			  		return true ;
			  
			  }
			  		return false ;
		
	
	}


	public function atualizar(){
		try {

			  //abrir conexao com o banco
			  $pdo = new \PDO(DSN, USER, PASSWD);
			  //cria sql
			  $sql = "UPDATE Discipulo SET 	nome = ? , telefone = ? , email = ? ,endereco = ? , nivel = ?, 
				  lider = ?, celula = ? ,  ativo = ?, dataNascimento = ? , estadoCivilId = ? ,sexo = ? , alcunha = ?
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
			  $stm->bindParam(9 , $this->dataNascimento->format('Y-m-d')) ;
			  $stm->bindParam(10 , $this->estadoCivilId) ;
			  $stm->bindParam(11 , $this->sexo ) ;
			  $stm->bindParam(12 , $this->alcunha ) ;
			  $stm->bindParam(13, $this->id);

			  $resposta = $stm->execute();
			  $erro = $stm->errorCode();


			  if ($erro != '0000'){

					throw new \Exception ('Não foi possivel atualizar') ;
				}

			} catch ( \Exception $e ) {
		
				$this->erro= $e->getMessage();
		
			}
		  //fechar conexÃ£o
		  $pdo = null ;

		  return $resposta;
	
	}
	/*Recebe o id para nÃ£o listar este cadastro.
	 *
	 * */
	public function listarTodos($id){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Discipulo WHERE id != ?';

		$stm = $pdo->prepare($sql);
		$stm->bindParam(1,$id);

		$stm->execute();

		return $stm->fetchAll();

	}

	/*Pesquisa os nome dos discipulos.
	 *Retorna apenas os nomes.
	 *
	 * */
	public function pesquisaJson($nome){

		$nome = "%$nome%" ; // os '%%' funcionam como curingas na expressÃ£o revelando mais resultados.

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT nome AS value FROM Discipulo WHERE nome LIKE ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $nome);

		$stm->execute();

		$resposta = $stm->fetchAll();


		return $resposta ; 

	}

	public function listarTodosDiscipulos(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Discipulo';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		return $stm->fetchAll();

	}


	/*Listar todos os lideres do sistema
	 * mostra apenas os id e nomes.
	 *
	 * */

	public function listarLideres(){
	
		$pdo = new \PDO(DSN , USER , PASSWD) ;

		$sql = 'SELECT id , nome FROM Discipulo';

		$stm = $pdo->prepare($sql);
		$stm->bindParam(1,$id);

		$stm->execute();

		$resposta = array();

		while($ob = $stm->fetchObject('\discipulo\Modelo\Discipulo')){
			$resposta[$ob->id] = $ob ;
		}

		return $resposta ;
	}

	public function liderCelula(){
	
		$pdo = new \PDO(DSN , USER , PASSWD) ;

		$sql = 'SELECT c.nome AS nomeCelula , c.id AS id
					FROM Discipulo AS d, Celula AS c
					WHERE d.id = ? AND d.id = c.lider' ;

		$stm = $pdo->prepare($sql);
		$stm->bindParam(1,$this->id);

		$stm->execute();

		return $stm->fetchAll();
	
	}

	public function discipulosPorLider(){
	
		$pdo = new \PDO(DSN , USER , PASSWD) ;

		$sql = 'SELECT l.id AS liderId, l.nome AS Lider, d.id AS discipuloId, d.nome AS nomeDiscipulo, d.lider AS discipuloLiderId
				FROM Discipulo AS d
				INNER JOIN Discipulo AS l ON d.lider = l.id
				ORDER BY l.nome'; 

		$stm = $pdo->prepare($sql);

		$stm->execute();

		$respostas = $stm->fetchAll();

//		var_dump($respostas);

		$aux = array();

		foreach ( $respostas as $valor) {
				$i = $valor['liderId'] ;			 
				$j = $valor['discipuloId'] ;

				foreach($valor as  $v){

				  	$aux[$i]['lider']	= $valor['Lider'] ;	
				  	$aux[$i]['liderId']	= $valor['liderId'] ;	
						  
					$aux[$i]['discipulos'][$j] = array('nomeDiscipulo' => $valor['nomeDiscipulo'], 
							  										'discipuloId' => $valor['discipuloId'] ,
																	'discipulos' => array()  ) ;	
						
				}
		}
		
		$teste = array_chunk($aux, 1,true);

		$teste = array_merge($teste[0],$teste[1]) ;

		//var_dump($teste);

		return $aux;
	
	}


	/*Lista todos os Discipulos sem célula
	 *
	 *
	 * */
	public function semCelula($numPagina, $pagina){

		$numPagina = (int)$numPagina;
		$pagina = (int)$pagina;


		(int)$primeiroRegistro = ( $pagina * $numPagina ) - $numPagina ;

		$pdo = new \PDO(DSN , USER , PASSWD) ;

		$sql = 'SELECT * FROM Discipulo AS d WHERE ISNULL(d.celula) LIMIT ? , ?' ;

		$stm = $pdo->prepare($sql);
		$stm->bindParam(1, $primeiroRegistro ,\PDO::PARAM_INT);
		$stm->bindParam(2, $numPagina , \PDO::PARAM_INT );

		$stm->execute();

		$resposta = array();

		while($ob = $stm->fetchObject('\discipulo\modelo\Discipulo')){
			$resposta[$ob->id] = $ob ;
		
		}

		return $resposta ;
	
	}

	public function semLider($numPagina, $pagina){

		$numPagina = (int)$numPagina;
		$pagina = (int)$pagina;


		(int)$primeiroRegistro = ( $pagina * $numPagina ) - $numPagina ;

		$pdo = new \PDO(DSN , USER , PASSWD) ;

		$sql = 'SELECT * FROM Discipulo AS d WHERE ISNULL(d.lider) LIMIT ? , ?' ;

		$stm = $pdo->prepare($sql);
		$stm->bindParam(1, $primeiroRegistro ,\PDO::PARAM_INT);
		$stm->bindParam(2, $numPagina , \PDO::PARAM_INT );

		$stm->execute();

		$resposta = array();

		while($ob = $stm->fetchObject('\discipulo\modelo\Discipulo')){
			$resposta[$ob->id] = $ob ;
		
		}

		return $resposta ;
	
	}

	public function participaCelula(){
	
		$pdo = new \PDO(DSN , USER , PASSWD) ;

		$sql = 'SELECT c.nome AS nomeCelula FROM Discipulo AS d , Celula AS c WHERE c.id = d.celula and d.id = ? ' ;

		$stm = $pdo->prepare($sql);
		$stm->bindParam(1,$this->id);

		$stm->execute();

		return $stm->fetch();
	
	}


	/* listar todos menos os usuario logado atualmente, e com paginação
	 *
	 * */

	public function listarTodosPag($id, $numPagina , $pagina){

		$numPagina = (int)$numPagina;

		(int)$primeiroRegistro = ( $pagina * $numPagina ) - $numPagina ;

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Discipulo WHERE id != ? ORDER BY nome LIMIT ? , ? ';

		$stm = $pdo->prepare($sql);

		$stm->bindParam( 1 , $id, \PDO::PARAM_INT ) ;
		$stm->bindParam( 2 , $primeiroRegistro, \PDO::PARAM_INT ) ;
		$stm->bindParam( 3 , $numPagina, \PDO::PARAM_INT ) ;

		$stm->execute();

		$stm->errorInfo();

		$resposta = array();

		while($ob = $stm->fetchObject('\discipulo\modelo\Discipulo')){
			$resposta[$ob->id] = $ob ;
		
		}

		return $resposta ; 
	}
	
	/* total de discipulos cadastrados no sistema*/

	public static function totalDiscipulos(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT COUNT(*) AS total FROM Discipulo';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		return $stm->fetch();
		

	}

	public static function totalDiscipulosSemCelula(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT COUNT(*) AS total FROM Discipulo AS d WHERE ISNULL(d.celula) ';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		return $stm->fetch();
		

	}

	public static function totalDiscipulosSemLider(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT COUNT(*) AS total FROM Discipulo AS d WHERE ISNULL(d.lider) ';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		return $stm->fetch();

	}

	/* recebe total de registros, e numero por pagina de registros.*/
	public static function mostrarPaginacao( $total ,  $numPagina, $pagina){

	$total_paginas = $total/$numPagina;

	

	$prev = $pagina - 1 ;
	$next = $pagina + 1 ;

	// se página maior que 1 (um), então temos link para a página anterior
	if ($pagina > 1) 
		{
			$prev_link = '<a class = "btn" href=' ;
			$prev_link .= $_SERVER['REDIRECT_URL'];
			$prev_link .= "?pagina=$prev> Anterior </a>";
		} 
	else { // senão não há link para a página anterior
    		$prev_link = '<a href="#" class = "btn disabled" >Anterior<a>';
	}

	// se número total de páginas for maior que a página corrente, 
	// então temos link para a próxima página 
	 if ($total_paginas > $pagina) {
    		$next_link = '<a  class = "btn" href='.$_SERVER['REDIRECT_URL'].'?pagina='.$next.'>Proxima</a>';
	  } else { 
	// senão não há link para a próxima página
	    $next_link = '<a class = "btn disabled" href="#">Proxima</a>';
	  }

	// vamos arredondar para o alto o número de páginas  que serão necessárias para exibir todos os 
	// registros. Por exemplo, se  temos 20 registros e mostramos 6 por página, nossa variável  
	// $total_paginas será igual a 20/6, que resultará em 3.33. Para exibir os  2 registros 
	// restantes dos 18 mostrados nas primeiras 3 páginas (0.33),  será necessária a quarta página. 
	// Logo, sempre devemos arredondar uma  fração de número real para um inteiro de cima e isto é 
	// feito com a  função ceil()/  
	$total_paginas = ceil($total_paginas);

	  $painel = '';

	  for ($x=1; $x<= $total_paginas; $x++) {
		  if ($x==$pagina) { 
		// se estivermos na página corrente, não exibir o link para visualização desta página 
	      	$painel .= '<a class = "btn disabled" > '.$x.'</a> ';
	    	} else {
			$painel .= ' <a  class = "btn" href=' ; 
			$painel .= $_SERVER['REDIRECT_URL'] ;
			$painel .= '?pagina='.$x.'>'.$x.'</a>';
	    }
	  }
	// exibir painel na tela
	  echo ''.$prev_link.' | '.$painel.' | '.$next_link.'';

  }



	public function excluir(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'DELETE FROM Discipulo WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();

	}

	
	/*Lista apenas um Disicpulo
	*/

	public function listarUm(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Discipulo WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();

		return $stm->fetchObject('\discipulo\Modelo\Discipulo');

	}

	
	public function entrar(){
		
		try {
		//conectar ao banco de dados
			$pdo = new \PDO(DSN, USER, PASSWD);	
			//montar o comando
			$sql = "SELECT * FROM Discipulo  WHERE email =? AND senha =? AND ativo = ?";
		//preparar o comando
			$stm = $pdo->prepare($sql);
			$ativo = 1 ;

		//trocar valores
			$stm->bindParam(1, $this->email);
			$stm->bindParam(2, md5($this->senha));
			$stm->bindParam(3, $ativo);

		//executar o comando
			$resposta =$stm->execute();
			$erros = $stm->errorInfo();
			

			if(!empty($erros[2])){
				throw new \Exception($erros[2]);
	
			}
		
		//fechar conexao
			$pdo=null;

			if($resposta){
				
				return  $stm -> fetch();
		
			}

			return false;
		}

		catch(\Exception $e){
			$this->erros['banco'] = $e->getMessage();
		
		
		}


	
	
	}

	/* destroi a sessÃ£o do usuario
	 *
	 * */
	public function sair(){
	
		session_start();
		session_destroy();
	
	}


	/* devolve uma lista de discipulos com nome especificado.
	 *
	 * */

	public function chamar($nome){

		$nome = "%$nome%" ; // os '%%' funcionam como curingas na expressÃ£o revelando mais resultados.

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Discipulo WHERE nome LIKE ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $nome);

		$stm->execute();

		$resposta = array();

		while($ob = $stm->fetchObject('\discipulo\modelo\Discipulo')){
			$resposta[$ob->id] = $ob ;
		
		}

		return $resposta ; 

	}

	public function fichaPorStatus($idStatus){

			  $pdo = new \PDO ( DSN, USER, PASSWD ) ;
	
		$sql = "


SELECT *
		  FROM Discipulo AS d, StatusCelular st
		  WHERE d.id = st.discipuloId
		  AND st.tipoStatusCelular =? order by d.nome" ;  		

/*$sql = ' 
				select s2.id AS idStatus, ultimo, nome , ,s3.id  from StatusCelular s2 inner join 

				(select 
				d.id AS id , d.nome AS nome ,
				(
				SELECT  id 
				FROM StatusCelular AS s1 
				WHERE s1.discipuloId = d.id
				ORDER BY dataInicio DESC
				limit 1
				)  AS ultimo
				from Discipulo AS d 
				where  1
				group by d.id
				) AS s3 on ultimo = s2.id

				WHERE s2.tipoStatusCelular = ?
				order by nome
';*/

			  $stm = $pdo->prepare($sql);

			  $stm->bindParam(1, $idStatus);

			  $stm->execute();
				
		$resposta = array();

		while($ob = $stm->fetchObject('\discipulo\modelo\Discipulo')){
			$resposta[$ob->id] = $ob ;
		
		}

		return $resposta ; 

	
	}

	public function listarDiscipulos(){
	
		$pdo = new \PDO (DSN, USER,PASSWD) ;

		$sql = 'SELECT * FROM Discipulo WHERE lider = ? ORDER BY nome' ;

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1,$this->id);

		$stm->execute();

		$resposta = array();

		while($ob = $stm->fetchObject('\discipulo\modelo\Discipulo')){
			$resposta[$ob->id] = $ob ;
		
		}
		return $resposta ;
	
	}

}
?> 
