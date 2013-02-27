<?php

namespace celula\modelo;

class relatorioCelula{

	private $id;
	private $dataEnvio;
	private $texto;
	private $titulo;
	private $lider;
	private $celulaId;

	public function __construct (){
	}

	public function __get($prop){
		return $this->$prop;
	
	}
	
	public function __set($prop , $valor){
		$this->$prop = $valor;
	
	}

	public function getLider(){
		$discipulo = new \discipulo\Modelo\Discipulo() ;
		$discipulo->id = $this->lider ;
		return $discipulo->listarUm() ;
	}
		
	public function salvar(){

	//abrir conexao com o banco
	$pdo = new \PDO(DSN, USER, PASSWD);
	//cria sql
	$sql = "INSERT INTO RelatorioCelula (
					dataEnvio, texto, titulo, 
					lider, celulaId	)
		VALUES (?,?,?,?,?)";

	$stm = $pdo->prepare($sql);

	$stm->bindParam(1, $this->dataEnvio );
	$stm->bindParam(2, $this->texto );
	$stm->bindParam(3, $this->titulo );
	$stm->bindParam(4, $this->lider );
	$stm->bindParam(5, $this->celulaId );

	$resposta = $stm->execute();

	//fechar conexÃ£o
	$pdo = null ;

	return $resposta;
	
	}

	public function atualizar(){

	//abrir conexao com o banco
	$pdo = new \PDO(DSN, USER, PASSWD);
	//cria sql
	$sql = "UPDATE Celula SET 	nome = ? , horarioFuncionamento = ? , endereco = ?, 
		lider = ?
		WHERE id = ?
					";
	//prepara sql
	$stm = $pdo->prepare($sql);
	//trocar valores
	$stm->bindParam(1, $this->nome);
	$stm->bindParam(2, $this->horarioFuncionamento);
	$stm->bindParam(3, $this->endereco);
	$stm->bindParam(4, $this->lider);
	$stm->bindParam(5, $this->id);

	$resposta = $stm->execute();


	//fechar conexÃ£o
	$pdo = null ;

	return $resposta;
	
	}
	/*Recebe o id para nÃ£o listar este cadastro.
	 *
	 * */
	public function listarTodos(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM RelatorioCelula WHERE celulaId = ? ORDER BY dataEnvio';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1,$this->celulaId);

		$stm->execute();

		$resposta = array();

		while($ob = $stm->fetchObject('\celula\modelo\relatorioCelula')){
			$resposta[$ob->id] = $ob ;
		
		}

		return $resposta ; 

	}

	public static function porData($inicio, $fim){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'select * from RelatorioCelula WHERE dataEnvio between ? and ?' ;

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1,$inicio);
		$stm->bindParam(2,$fim);

		$stm->execute();

		$resposta = array();

		while($ob = $stm->fetchObject('\celula\modelo\relatorioCelula')){
			$resposta[$ob->id] = $ob ;
		}

		return $resposta ; 

	}

	public static function envioPorCelula($inicio, $fim){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql =  'select c.id AS celulaID, c.nome AS celulaNome, r.id AS relatorioId, r.titulo, r.dataEnvio, c.id AS id
						from 
						Celula AS c left join RelatorioCelula AS r 
						on 
						c.id = r.celulaId and r.dataEnvio between ? and ?
						WHERE 1
						group by c.id
						order by  c.nome' ;

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1,$inicio);
		$stm->bindParam(2,$fim);

		$stm->execute();

		$resposta = array();

		while($ob = $stm->fetchObject('\celula\modelo\relatorioCelula')){
			$resposta[$ob->id] = $ob ;
		}

		return $resposta ; 

	}


	/*Listar todos os lideres do sistema
	 * mostra apenas os id e nomes.
	 *
	 * */

	public function listarLideres(){
	
		$pdo = new \PDO(DSN , USER , PASSWD) ;

		$sql = 'SELECT id , nome FROM Discipulo ORDER BY nome';

		$stm = $pdo->prepare($sql);
		$stm->bindParam(1,$id);

		$stm->execute();

		return $stm->fetchAll();
	
	}

	public function listarLideresCelula(){
	
		$pdo = new \PDO(DSN , USER , PASSWD) ;

		$sql = 'SELECT Discipulo.id , Discipulo.nome, COUNT( Discipulo.id ) AS totalCelulas
					 FROM Celula , Discipulo
					 WHERE Celula.lider = Discipulo.id
					 GROUP BY Discipulo.id ORDER BY Discipulo.nome';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		return $stm->fetchAll();
	
	}


	/* listar todos menos os usuario logado atualmente, e com paginação
	 *
	 * */

	public function listarTodosPag($id, $numPagina , $pagina){

		$numPagina = (int)$numPagina;

		(int)$primeiroRegistro = ( $pagina * $numPagina ) - $numPagina ;

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Discipulo WHERE id != ? LIMIT ? , ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam( 1 , $id, \PDO::PARAM_INT ) ;
		$stm->bindParam( 2 , $primeiroRegistro, \PDO::PARAM_INT ) ;
		$stm->bindParam( 3 , $numPagina, \PDO::PARAM_INT ) ;

		$stm->execute();

		$stm->errorInfo();

		return $stm->fetchAll();

	}


	public function listarDiscipulos(){
	
		$pdo = new \PDO (DSN, USER,PASSWD) ;

		$sql = 'SELECT * FROM Discipulo WHERE celula = ? ORDER BY nome' ;

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1,$this->id);

		$stm->execute();

		return $stm->fetchAll() ;


	
	
	}
	
	/* total de discipulos cadastrados no sistema*/

	public static function totalCelulas(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT COUNT(*) AS total FROM Celula';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		$resposta = $stm->fetch();

		return $resposta['total'] ;
		

	}

	/* recebe total de registros, e numero por pagina de registros.*/
	public static function mostrarPaginacao( $total ,  $numPagina, $pagina){

	$total_paginas = $total/$numPagina;

	$prev = $pagina - 1 ;
	$next = $pagina + 1 ;
	// se página maior que 1 (um), então temos link para a página anterior
	if ($pagina > 1) 
		{
			$prev_link = '<a href=' ;
			$prev_link .= $_SERVER['REDIRECT_URL'];
			$prev_link .= "?pagina=$prev> Anterior </a>";
		} 
	else { // senão não há link para a página anterior
    		$prev_link = 'Anterior';
	}

	// se número total de páginas for maior que a página corrente, 
	// então temos link para a próxima página 
	 if ($total_paginas > $pagina) {
    		$next_link = '<a href='.$_SERVER['REDIRECT_URL'].'?pagina='.$next.'>Proxima';
	  } else { 
	// senão não há link para a próxima página
	    $next_link = "Proxima";
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
	      	$painel .= ' ['.$x.'] ';
	    	} else {
			$painel .= ' <a href=' ; 
			$painel .= $_SERVER['REDIRECT_URL'] ;
			$painel .= '?pagina='.$x.'>['.$x.']</a>';
	    }
	  }
	// exibir painel na tela
	  echo "$prev_link | $painel | $next_link";
  }



	public function excluir(){
	try{
		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'DELETE FROM Celula WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$resposta = $stm->execute();
		$erro = $stm->errorCode();
		 
		if ($erro != '0000'){

			 throw new \Exception ('Existe discípulos cadastrados nessa célula') ;
		}
		}catch ( \Exception $e ) {
		
				  $this->erro= $e->getMessage();
	}

	}

	
	/*Lista apenas um Disicpulo
	*/

	public function listarUm(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM RelatorioCelula WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();


		return $stm->fetchObject('\celula\modelo\relatorioCelula');

	}

	
	public function entrar(){

		
		try {
		//conectar ao banco de dados
			$pdo = new \PDO(DSN, USER, PASSWD);	
			//montar o comando
			$sql = "SELECT * FROM Discipulo  WHERE usuario =? AND senha =?";
		//preparar o comando
			$stm = $pdo->prepare($sql);

		//trocar valores
			$stm->bindParam(1, $this->usuario);
			$stm->bindParam(2, md5($this->senha));

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

		$sql = 'SELECT * FROM Celula WHERE nome LIKE ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $nome);

		$stm->execute();

		return $stm->fetchAll();
		

	
	
	}


}
?> 
