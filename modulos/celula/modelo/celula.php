<?php
namespace celula\modelo;

use discipulo\Modelo\Discipulo;
use \framework\modelo\modeloFramework;

class celula extends modeloFramework
{
    private $id;
    private $nome;
    private $horarioFuncionamento;
    private $endereco;
    private $lider;
    private $ativa;
    private $tipoRedeId;
    private $erro;

    public function __construct ( $id = NULL )
    {
        if (!is_null($id) ) {
            $this->id = $id ;
             $obj = $this->listarUm() ;

            $this->nome = $obj->nome ;
            $this->horarioFuncionamento = $obj->horarioFuncionamento ;
            $this->endereco = $obj->endereco ;
            $this->lider = $obj->lider ;
        }
    }

    public function __get($prop)
    {
        return $this->$prop;

    }

    public function __set($prop , $valor)
    {
        $this->$prop = $valor;

    }

    public function pegaLider()
    {
        $discipulo = new \discipulo\Modelo\Discipulo();
        $discipulo->id = $this->lider ;
        $discipulo = $discipulo->listarUm();

        return $discipulo;

    }

    public function pegaRede()
    {
        $tipoRede = new \rede\modelo\tipoRede();
        $tipoRede->id = $this->tipoRedeId ;
        $this->tipoRedeId = $tipoRede->listarUm();

        //var_dump($this->tipoRedeId);
        return $this->tipoRedeId ;

    }

    public function salvar()
    {
    //abrir conexao com o banco
    $pdo = new \PDO(DSN, USER, PASSWD);
    //cria sql
    $sql = "INSERT INTO Celula (
                    nome, horarioFuncionamento, endereco,
                    lider,dataCriacao	)
        VALUES (?,?,?,?,now())";
    //prepara sql
    $stm = $pdo->prepare($sql);
    //trocar valores
    $stm->bindParam(1, $this->nome);
    $stm->bindParam(2, $this->horarioFuncionamento);
    $stm->bindParam(3, $this->endereco);
    $stm->bindParam(4, $this->lider);

    $resposta = $stm->execute();

    //fechar conexÃ£o
    $pdo = null ;

    return $resposta;

    }

    public function atualizar()
    {
        //abrir conexao com o banco
        $pdo = new \PDO(DSN, USER, PASSWD);
        //cria sql
        $sql = "UPDATE Celula SET 	nome = ? , horarioFuncionamento = ? , endereco = ?,
            lider = ? , tipoRedeId = ? , ativa = ?, multiplicacao = ?
            WHERE id = ?
               ";
        //prepara sql
        $stm = $pdo->prepare($sql);
        //trocar valores
        $stm->bindParam(1, $this->nome);
        $stm->bindParam(2, $this->horarioFuncionamento);
        $stm->bindParam(3, $this->endereco);
        $stm->bindParam(4, $this->lider);
        $stm->bindParam(5, $this->tipoRedeId );
        $stm->bindParam(6, $this->ativa );
        $stm->bindParam(7, $this->multiplicacao );
        $stm->bindParam(8, $this->id);

        $resposta = $stm->execute();

        //fechar conexÃ£o
        $pdo = null ;

        return $resposta;
    }
    /*Recebe o id para nÃ£o listar este cadastro.
     *
     * */
    public function listarTodos()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT * FROM Celula ORDER BY nome';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ( $obj = $stm->fetchObject('\celula\modelo\celula') ) {
            $resposta[$obj->id] = $obj ;
        }

        return $resposta ;
    }

    public function listarTodosAtivos()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT * FROM Celula WHERE ativa=1 ORDER BY nome ';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ( $obj = $stm->fetchObject('\celula\modelo\celula') ) {
            $resposta[$obj->id] = $obj ;
        }

        return $resposta ;
    }

    public function listarTodosInativos()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT * FROM Celula WHERE ativa=0 ORDER BY nome ';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ( $obj = $stm->fetchObject('\celula\modelo\celula') ) {
            $resposta[$obj->id] = $obj ;
        }

        return $resposta ;
    }

    public function listarCelulasPorRede()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT c.* FROM Celula as c left join TipoRede  as t on c.tipoRedeId = t.id order by t.nome';

        $stm = $pdo->prepare($sql);

        //$stm->bindParam(1, $this->id);

        $stm->execute();
        $resposta = array();

        while ( $obj = $stm->fetchObject('\celula\modelo\celula') ) {
            $resposta[$obj->id] = $obj ;
        }

        return $resposta ;
    }

    /*Listar todos os lideres do sistema
     * mostra apenas os id e nomes.
     *
     * */

    public function listarLideres()
    {
        $pdo = new \PDO(DSN , USER , PASSWD) ;

        $sql = 'SELECT id , nome FROM Discipulo ORDER BY nome';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$id);

        $stm->execute();

        return $stm->fetchAll();

    }

    public function lideresPorStatus($id)
    {
        $pdo = new \PDO(DSN , USER , PASSWD) ;

        $sql = '
                        SELECT	l.id AS liderId, l.nome AS lider , d.id as discipuloId,d.nome AS discipulo, ts.nome AS status
                        FROM
                        Discipulo AS d INNER JOIN
                        Discipulo AS l ON d.lider = l.id AND d.ativo = 1
                        INNER JOIN
                        StatusCelular AS sc ON sc.ativo =1 AND sc.discipuloId = d.id
                        INNER JOIN
                            TipoStatusCelular AS ts
                        ON ts.id = sc.tipoStatusCelular

                        WHERE sc.tipoStatusCelular = ?
                        ORDER BY lider, discipulo
                        ';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$id);

        var_dump($stm->errorInfo());

        $stm->execute();

        return $stm->fetchAll();

    }

    /*public function lideresSemStatus($id){
        $pdo = new \PDO(DSN , USER , PASSWD) ;

        $sql = '
SELECT
l.id AS liderId, l.nome AS lider , d.nome AS discipulo, ts.nome AS status
FROM
Discipulo AS d INNER JOIN
Discipulo AS l ON d.lider = l.id
INNER JOIN
StatusCelular AS sc ON sc.ativo =1 AND sc.discipuloId = d.id
INNER JOIN
TipoStatusCelular AS ts
ON ts.id = sc.tipoStatusCelular

WHERE sc.tipoStatusCelular != ? AND l.id not in (

SELECT
l.id
-- AS liderId, l.nome AS lider , d.nome AS discipulo, sc.tipoStatusCelular
FROM
Discipulo AS d INNER JOIN
Discipulo AS l ON d.lider = l.id
INNER JOIN
StatusCelular AS sc ON sc.ativo = 1 AND sc.discipuloId = d.id
WHERE sc.tipoStatusCelular = ?


)
ORDER BY lider, discipulo


                        ';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$id);
        $stm->bindParam(2,$id);

        $stm->execute();

        return $stm->fetchAll();

    }*/

    public function lideresSemStatus($id)
    {
        $pdo = new \PDO(DSN , USER , PASSWD) ;

/*		$sql = '
SELECT
l.id AS liderId, l.nome AS lider , d.nome AS discipulo, ts.nome AS status
FROM
Discipulo AS d INNER JOIN
Discipulo AS l ON d.lider = l.id
INNER JOIN
StatusCelular AS sc ON sc.ativo =1 AND sc.discipuloId = d.id
INNER JOIN
TipoStatusCelular AS ts
ON ts.id = sc.tipoStatusCelular

WHERE sc.tipoStatusCelular != ? AND l.id not in (

SELECT
l.id
-- AS liderId, l.nome AS lider , d.nome AS discipulo, sc.tipoStatusCelular
FROM
Discipulo AS d INNER JOIN
Discipulo AS l ON d.lider = l.id
INNER JOIN
StatusCelular AS sc ON sc.ativo = 1 AND sc.discipuloId = d.id
WHERE sc.tipoStatusCelular =?

)

union

select d.id , d.nome  as lider , \'não lider\' , \'não tem sttus\' from Discipulo AS d
WHERE d.id not in (
SELECT
l.id
FROM
Discipulo AS l INNER JOIN
Discipulo AS d ON d.lider = l.id
)

order by lider
';*/
        $sql = '
                        SELECT l.id AS liderId, l.nome AS lider , d.nome AS discipulo, ts.nome AS status
FROM
    Discipulo AS d
INNER JOIN
    Discipulo AS l ON d.lider = l.id and d.ativo = 1
INNER JOIN
    StatusCelular AS sc ON sc.ativo = 1 AND sc.discipuloId = d.id
INNER JOIN
    TipoStatusCelular AS ts ON ts.id = sc.tipoStatusCelular

WHERE sc.tipoStatusCelular != ?
    AND l.id not in (

    SELECT l.id
    FROM
            Discipulo AS d INNER JOIN
            Discipulo AS l ON d.lider = l.id AND d.ativo = 1
        INNER JOIN
            StatusCelular AS sc ON sc.ativo = 1 AND sc.discipuloId = d.id
        WHERE sc.tipoStatusCelular = ?
    )

                        ' ;

        $stm = $pdo->prepare($sql);
        $stm->bindParam(1,$id);
        $stm->bindParam(2,$id);

        $stm->execute();

        return $stm->fetchAll();

    }

    public function lideresPorTodosStatus()
    {
        $pdo = new \PDO(DSN , USER , PASSWD) ;

        $sql = '
                        SELECT
                            l.id AS liderId, l.nome AS lider , d.nome AS discipulo, ts.nome AS status FROM
Discipulo AS d INNER JOIN
Discipulo AS l ON d.lider = l.id
INNER JOIN
StatusCelular AS sc ON sc.ativo =1 AND sc.discipuloId = d.id
INNER JOIN
TipoStatusCelular AS ts
ON ts.id = sc.tipoStatusCelular

ORDER BY lider, discipulo
                        ';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        return $stm->fetchAll();

    }

    public function statusPorLiderCelula($id)
    {
        $pdo = new \PDO(DSN , USER , PASSWD) ;

        $sql = '
-- Discipulos que não tem pessoas em consolidacao
Select did, dnome, if (d.id=4,null,null) as id , if (d.nome=4, null ,null ) as nome  , if ( sc.tipoStatusCelular= 4 ,NULL , NULL ) as tipoStatusCelular, 0 as tem
from (
    -- lideres de celula
    select disc.id as did , disc.nome as dnome , cel.id as cid from
    Discipulo AS disc inner join Celula AS cel on disc.id = cel.lider and disc.ativo = 1
    group by did
 ) as l
left join Discipulo AS d ON d.lider = l.did and d.ativo = 1
left join StatusCelular as sc ON sc.discipuloId = d.id and sc.ativo =1  and sc.tipoStatusCelular !=  :statusId
where l.did not in (
-- lider com discipulo em consolidacao
select did -- , dnome, cid,d.nome  , sc.tipoStatusCelular
from (
-- lideres de celula
select disc.id as did , disc.nome as dnome , cel.id as cid from
Discipulo AS disc inner join Celula AS cel on disc.id = cel.lider and disc.ativo = 1
group by did
 ) as l left join Discipulo AS d ON d.lider = l.did and d.ativo = 1

  inner join StatusCelular as sc ON sc.discipuloId = d.id and sc.ativo =1  and sc.tipoStatusCelular =  :statusId
group by did
--
)

union

-- lider com discipulos em consolidacao
Select did, dnome, d.id , d.nome  , sc.tipoStatusCelular , 1 as t
from (
-- lideres de celula
    select disc.id as did , disc.nome as dnome , cel.id as cid from
    Discipulo AS disc inner join Celula AS cel on disc.id = cel.lider and disc.ativo = 1
    group by did
    ) as l
left join Discipulo AS d ON d.lider = l.did and d.ativo = 1
inner join StatusCelular as sc ON sc.discipuloId = d.id and sc.ativo =1  and sc.tipoStatusCelular =  :statusId
order by dnome
                        ';

        $stm = $pdo->prepare($sql);
        $stm->bindParam(':statusId',$id);

        //var_dump($stm->errorInfo());

        $stm->execute();

        return $stm->fetchAll();

    }

    public function listarLideresCelula()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT Discipulo.id , Discipulo.nome, COUNT( Discipulo.id ) AS totalCelulas
                     FROM Celula , Discipulo
                     WHERE Celula.lider = Discipulo.id
                     GROUP BY Discipulo.id ORDER BY Discipulo.nome';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        //return $stm->fetchAll();

        //$stm->execute();
        $resposta = array();

        while ( $obj = $stm->fetchObject ('\discipulo\Modelo\Discipulo') ) {
            $resposta[$obj->id] = $obj ;
        }

        return $resposta;

    }

    public function listarCelulasLider()
    {
        $pdo = new \PDO(DSN , USER , PASSWD) ;

        $sql = 'SELECT * FROM Celula WHERE lider = ? ' ;

        $stm = $pdo->prepare($sql);
        $stm->bindParam( 1 , $this->lider ) ;

        $stm->execute();
        $resposta = array();

        while ( $obj = $stm->fetchObject ('\celula\modelo\celula') ) {
            $resposta[$obj->id] = $obj ;
        }

        return $resposta;

    }

    public function listarCelulasLiderInativos()
    {
        $pdo = new \PDO(DSN, USER, PASSWD) ;

        $sql = 'SELECT * FROM Celula WHERE lider = ?  AND ativa = 0 ';

        $stm = $pdo->prepare($sql);
        $stm->bindParam( 1 , $this->lider );

        $stm->execute();
        $resposta = array();

        while ( $obj = $stm->fetchObject ('\celula\modelo\celula') ) {
            $resposta[$obj->id] = $obj;
        }

        return $resposta;
    }

    /* listar todos menos os usuario logado atualmente, e com paginação
     *
     * */

    public function listarTodosPag($id, $numPagina , $pagina)
    {
        $numPagina = (int) $numPagina;

        (int) $primeiroRegistro = ( $pagina * $numPagina ) - $numPagina ;

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

    public function listarDiscipulos()
    {
        $pdo = new \PDO (DSN, USER,PASSWD) ;

        $sql = 'SELECT * FROM Discipulo WHERE celula = ? and Discipulo.ativo =1 ORDER BY nome' ;

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1,$this->id);

        $stm->execute();

        $resposta = array();

        while ( $obj = $stm->fetchObject('\discipulo\Modelo\Discipulo') ) {
            $resposta[$obj->id] = $obj ;
        }

        return $resposta ;

    }

    /* total de discipulos cadastrados no sistema*/

    public static function totalCelulas()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT COUNT(*) AS total FROM Celula';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = $stm->fetch();

        return $resposta['total'] ;

    }

    public function listarParticipacao()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'select
d.nome , p.discipuloId, p.relatorioCelulaId , count(*) as total
from
Discipulo AS d 		inner join
ParticipacaoCelula as p on p.discipuloId = d.id inner join
RelatorioCelula as r on r.id = p.relatorioCelulaId

Where r.celulaId = ?
group by d.id
                        ';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1,$this->id);

        $stm->execute();
        $resposta = $stm->fetchAll();

        return $resposta ;

    }

    /* recebe total de registros, e numero por pagina de registros.*/
    public static function mostrarPaginacao( $total ,  $numPagina, $pagina)
    {
    $total_paginas = $total/$numPagina;

    $prev = $pagina - 1 ;
    $next = $pagina + 1 ;
    // se página maior que 1 (um), então temos link para a página anterior
    if ($pagina > 1) {
            $prev_link = '<a href=' ;
            $prev_link .= $_SERVER['REDIRECT_URL'];
            $prev_link .= "?pagina=$prev> Anterior </a>";
        } else { // senão não há link para a página anterior
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

    public function excluir()
    {
    try {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'DELETE FROM Celula WHERE id = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $resposta = $stm->execute();
        $erro = $stm->errorCode();

        if ($erro != '0000') {

             throw new \Exception ('Existe discípulos cadastrados nessa célula') ;
        }
        } catch ( \Exception $e ) {

                  $this->erro= $e->getMessage();
    }

    }

    /*Lista apenas um Disicpulo
    */

    public function listarUm()
    {
        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT * FROM Celula WHERE id = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();

        //var_dump ( $this->id);
        //var_dump ( $stm->errorInfo());
        //var_dump ( $stm->fetchObject());
        return $stm->fetchObject('\celula\modelo\celula');

    }

    public function entrar()
    {
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

            if (!empty($erros[2])) {
                throw new \Exception($erros[2]);

            }

        //fechar conexao
            $pdo=null;

            if ($resposta) {
                return  $stm -> fetch();

            }

            return false;
        } catch (\Exception $e) {
            $this->erros['banco'] = $e->getMessage();

        }

    }

    /* destroi a sessÃ£o do usuario
     *
     * */
    public function sair()
    {
        session_start();
        session_destroy();

    }

    /* devolve uma lista de discipulos com nome especificado.
     *
     * */

    public function chamar($nome)
    {
        $nome = "%$nome%" ; // os '%%' funcionam como curingas na expressÃ£o revelando mais resultados.

        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT * FROM Celula WHERE nome LIKE ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $nome);

        $stm->execute();

        return $stm->fetchAll();

    }


    public function porAlias()
    {

        $pdo = new \PDO (DSN,USER,PASSWD);

        $sql = 'SELECT * FROM Celula WHERE alias = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->alias);

        $stm->execute();

        $result = $stm->fetchObject('\celula\modelo\celula');
        return $result;
    }
}
