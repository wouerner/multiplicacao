<?php
namespace celula\modelo;
class celula{

	private $id;
	private $nome;
	private $horarioFuncionamento;
	private $endereco;
	private $lider;

	public function __construct (){
	}

	public function __get($prop){
		return $this->$prop;
	
	}
	
	public function __set($prop , $valor){
		$this->$prop = $valor;
	
	}

		
	public function salvar(){

	//abrir conexao com o banco
	$pdo = new \PDO(DSN, USER, PASSWD);
	//cria sql
	$sql = "INSERT INTO Celula (
					nome, horarioFuncionamento, endereco, 
					lider	)
		VALUES (?,?,?,?)";
	//prepara sql
	$stm = $pdo->prepare($sql);
	//trocar valores
	$stm->bindParam(1, $this->nome);
	$stm->bindParam(2, $this->horarioFuncionamento);
	$stm->bindParam(3, $this->endereco);
	$stm->bindParam(4, $this->lider);

	$resposta = $stm->execute();

	//fechar conexão
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

	//$erro = $stm->errorInfo();
	//var_dump($erro);
	//exit();

	//fechar conexão
	$pdo = null ;

	return $resposta;
	
	}
	/*Recebe o id para não listar este cadastro.
	 *
	 * */
	public function listarTodos(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Celula';

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

		return $stm->fetchAll();
	
	}


	/* listar todos menos os usuario logado atualmente, e com pagina��o
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

		$sql = 'SELECT * FROM Discipulo WHERE celula = ?' ;

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1,$this->id);

		$stm->execute();

		return $stm->fetchAll() ;


	
	
	}
	
	/* total de discipulos cadastrados no sistema*/

	public static function totalDiscipulos(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT COUNT(*) AS total FROM Discipulo';

		$stm = $pdo->prepare($sql);

		$stm->execute();

		return $stm->fetch();
		

	}

	/* recebe total de registros, e numero por pagina de registros.*/
	public static function mostrarPaginacao( $total ,  $numPagina, $pagina){

	$total_paginas = $total/$numPagina;

	$prev = $pagina - 1 ;
	$next = $pagina + 1 ;
	// se p�gina maior que 1 (um), ent�o temos link para a p�gina anterior
	if ($pagina > 1) 
		{
			$prev_link = '<a href=' ;
			$prev_link .= $_SERVER['REDIRECT_URL'];
			$prev_link .= "?pagina=$prev> Anterior </a>";
		} 
	else { // sen�o n�o h� link para a p�gina anterior
    		$prev_link = 'Anterior';
	}

	// se n�mero total de p�ginas for maior que a p�gina corrente, 
	// ent�o temos link para a pr�xima p�gina 
	 if ($total_paginas > $pagina) {
    		$next_link = '<a href='.$_SERVER['REDIRECT_URL'].'?pagina='.$next.'>Proxima';
	  } else { 
	// sen�o n�o h� link para a pr�xima p�gina
	    $next_link = "Proxima";
	  }

	// vamos arredondar para o alto o n�mero de p�ginas  que ser�o necess�rias para exibir todos os 
	// registros. Por exemplo, se  temos 20 registros e mostramos 6 por p�gina, nossa vari�vel  
	// $total_paginas ser� igual a 20/6, que resultar� em 3.33. Para exibir os  2 registros 
	// restantes dos 18 mostrados nas primeiras 3 p�ginas (0.33),  ser� necess�ria a quarta p�gina. 
	// Logo, sempre devemos arredondar uma  fra��o de n�mero real para um inteiro de cima e isto � 
	// feito com a  fun��o ceil()/  
	$total_paginas = ceil($total_paginas);

	  $painel = '';

	  for ($x=1; $x<= $total_paginas; $x++) {
		  if ($x==$pagina) { 
		// se estivermos na p�gina corrente, n�o exibir o link para visualiza��o desta p�gina 
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

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'DELETE FROM Celula WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();

	}

	
	/*Lista apenas um Disicpulo
	*/

	public function listarUm(){

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Celula WHERE id = ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $this->id);

		$stm->execute();

		return $stm->fetch();

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

	/* destroi a sessão do usuario
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

		$nome = "%$nome%" ; // os '%%' funcionam como curingas na expressão revelando mais resultados.

		$pdo = new \PDO (DSN,USER,PASSWD);	

		$sql = 'SELECT * FROM Celula WHERE nome LIKE ?';

		$stm = $pdo->prepare($sql);

		$stm->bindParam(1, $nome);

		$stm->execute();

		return $stm->fetchAll();
		

	
	
	}


}
?> 