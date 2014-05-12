<?php

namespace relatorio\modelo;

class discipulos
{
    function ordenar($a, $b) { return strnatcmp($a['lastname'], $b['lastname']); }

    public function discipulosResumido($idadeMaxima,$idadeMinima,$sexo, $estadoCivil,$status , $celula , $rede=NULL , $ativo,$lider )
    {
              $pdo = new \PDO(DSN,USER,PASSWD);

              $s=$sexo;
              $estado=$estadoCivil;
              $st=$status;
              $c=$celula;
                $r = $rede ;
                $l = $lider ;

              if ($sexo == 'todos') {
              $sexo ='';
              } else {
              $sexo ='AND sexo = :sexo ';
              }

              if ($estadoCivil == 'todos') {
              $estadoCivil ='';
              } else {
              $estadoCivil='AND d.estadoCivilId = :estadoCivil ';
              }

              if ($status == 'todos') {
              $status ='';
              } else {
              $status='AND	StatusCelular.tipoStatusCelular = :status ';
              }

              if ($celula == 'todos') {
              $celula ='';
              } else {
              $celula ='AND d.celula = :celula' ;
              }

              if ($rede == 'todos') {
              $rede ='';
              } else {
              $rede ='AND  r.tipoRedeId = :rede ';
              }

              if ($ativo == 'todos') {
              $ativo ='';
              } elseif ($ativo == 1) {
              $ativo ='AND d.ativo = 1' ;
                } else {
              $ativo ='AND d.ativo = 0' ;
                }

              if ($lider == 'todos') {
              $lider ='';
              } else {
              $lider ='AND  d.lider = :lider ';
              }

                    $sql='SELECT DISTINCT
                                d.id, d.nome , d.alcunha , d.dataNascimento, d.sexo, d.estadoCivilId, d.telefone, d.email, d.endereco, d.lider, d.celula, d.ativo
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

              $res = array();

              while ($s =$stm->fetchObject('\discipulo\Modelo\Discipulo')  ) {

                      //$resposta[$s->id] =$s ;

                    //$lider = $s->getLider();

                      //$res[$s->lider]['lider'] = $lider->nome ;
                      //$res[$s->lider][] = $s ;
                      $res[$s->id] = $s ;

              }

                //var_dump($sql);
                //var_dump($res);
                /*exit();*/
              //usort($res, function($a, $b) { return strnatcmp($a['lider'], $b['lider']); });
                return $res;

    }

    public function liderComDiscipulos()
    {
              $pdo = new \PDO(DSN,USER,PASSWD);

              $sql = 'SELECT DISTINCT l.id AS liderId, l.nome AS nomeLider, l.endereco, l.telefone, l.dataNascimento , d.id AS discipuloId, d.nome AS nomeDiscipulo
                            FROM Discipulo AS d, Discipulo AS l
                            WHERE d.lider = l.id
                            ORDER BY l.nome';

                $stm = $pdo->prepare($sql);

                $stm->execute();

                $resposta	= array();
                while ($lider = $stm->fetchObject('\discipulo\Modelo\Discipulo')) {
                    $resposta[$lider->liderId]['lider'] =   $lider->nomeLider;
                    $resposta[$lider->liderId][$lider->discipuloId] = $lider;

                }

                //print("<pre>".var_dump($resposta)."</pre>"); exit();
                return $resposta;

    }

    public function graficoPorStatusCelular()
    {
            $pdo = new \PDO(DSN,USER,PASSWD);
            $sql = 'SELECT * , count( s.id ) AS quantidade
FROM StatusCelular AS s, TipoStatusCelular
WHERE s.tipoStatusCelular = TipoStatusCelular.id
GROUP BY tipoStatusCelular';
            $stm = $pdo->prepare($sql);

            $stm->execute();

            return $stm->fetchAll();
    }

    public function graficoPorEvento()
    {
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

    public function graficoPorCelula($celulaId)
    {
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

    public function aniversarianteMes(  $mes )
    {
            $pdo = new \PDO(DSN,USER,PASSWD);
            $sql = ' SELECT *
                        FROM Discipulo
                        WHERE month( dataNascimento ) = ? order by dayofmonth(dataNascimento)';

            $stm = $pdo->prepare($sql);
            $stm->bindParam( 1, $mes ) ;

            $stm->execute() ;

            $resposta = array();
            while ( $obj = $stm->fetchObject('\discipulo\Modelo\Discipulo') ) {
                $resposta[$obj->id] = $obj ;

            }

            return $resposta ;

    }

    public function statusPorLider($liderId, $statusId)
    {
            $pdo = new \PDO(DSN,USER,PASSWD);

            $sql = '
-- lider com discipulos em consolidacao
select
l.id, l.nome as nome, 1 as situacao, count(d.id) as total
from Discipulo as d inner join StatusCelular as sc
on sc.discipuloId = d.id and sc.ativo = 1 and sc.tipoStatusCelular = :statusCelularId

inner join Discipulo as l on l.id = d.lider

where d.lider in
(
-- ids dos 12
SELECT
d.id
FROM `Discipulo` as l left join Discipulo as d ON l.id = d.lider
WHERE d.lider = :liderId )
group by d.lider

union

-- não tem discipulos em consolicação
select
l.id  , l.nome as nome, 2 as situacao , 0 as total
from Discipulo as d inner join StatusCelular as sc
on sc.discipuloId = d.id and sc.ativo = 1 and sc.tipoStatusCelular != :statusCelularId
inner join Discipulo as l on l.id = d.lider
where d.lider in
(
-- ids dos 12
SELECT
d.id
FROM `Discipulo`

 as l left join Discipulo as d ON l.id = d.lider
WHERE d.lider = :liderId  )
-- group by d.lider
and d.lider not in (

select -- d.id, d.nome , sc.tipoStatusCelular ,
-- d.lider ,
l.id -- , l.nome, \'tem\'
from Discipulo as d inner join StatusCelular as sc
on sc.discipuloId = d.id and sc.ativo = 1 and sc.tipoStatusCelular = :statusCelularId
inner join Discipulo as l on l.id = d.lider
where d.lider in
(
-- ids dos 12
SELECT
d.id
FROM `Discipulo`

 as l left join Discipulo as d ON l.id = d.lider
WHERE d.lider = :liderId )
group by d.lider
)

group by d.lider

union

SELECT
l.id , l.nome as nome , 3, 0 as total
FROM Discipulo as l left join Discipulo as d on d.lider = l.id
where
l.id  in (
-- id dos 12
SELECT
d.id
FROM `Discipulo` as l left join Discipulo as d ON l.id = d.lider WHERE d.lider = :liderId
)
-- group by l.id
and l.id not in (
-- lider com discipulos
SELECT
l.id -- , l.nome, d.id ,d.nome
FROM Discipulo as l inner join Discipulo as d on d.lider = l.id
where
l.id  in (
-- id dos 12
SELECT
d.id
FROM `Discipulo` as l left join Discipulo as d ON l.id = d.lider WHERE d.lider = :liderId
)
group by l.id
)

order by nome


                            ';

            $stm = $pdo->prepare($sql);
            $stm->bindParam( ':liderId',$liderId ) ;
            $stm->bindParam( ':statusCelularId', $statusId ) ;

            $stm->execute() ;

            return $stm->fetchAll();

    }

    public function crescimento($inicio,$fim)
    {
        $begin = new \DateTime( $inicio );
        $end = new \DateTime( $fim );
       // $end = $end->modify( '+1 day' );

        $interval = new \DateInterval('P2D');
        $daterange = new \DatePeriod($begin, $interval ,$end);
        //var_dump($daterange);
        $select='';
        $select2='';

        foreach ($daterange as $date) {
            $select .= "q.`{$date->format('d-m-Y')}`,";
        }
        $select = substr($select,0,strlen($select)-1);

        foreach ($daterange as $date) {
            $select2 .= "SUM(IF(DATE_FORMAT(data,'%Y-%m-%d') = '{$date->format('Y-m-d')}',quantidade,0)) AS '{$date->format('d-m-Y')}',";
        }
        $select2 = substr($select2,0,strlen($select2)-1);

        //var_dump($select);
        //var_dump($select2);
        $sql = 'select '.$select.' from ( select  '.$select2.' from  QtdDiscipulosLider) as q';
    //    echo $sql;

            $pdo = new \PDO(DSN,USER,PASSWD);

            $stm = $pdo->prepare($sql);
            //$stm->bindParam(1,$);

            $stm->execute();

            return $stm->fetch(\PDO::FETCH_ASSOC);
    }

    public function crescimentoRede($inicio,$fim)
    {
        $begin = new \DateTime( $inicio );
        $end = new \DateTime( $fim );
        $end = $end->modify( '+1 day' );

        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($begin, $interval ,$end);
        //var_dump($daterange);
        $select='nomeRede,';
        $select2='';

        foreach ($daterange as $date) {
            $select .= " q.`{$date->format('d-m-Y')}`,";
        }
        $select = substr($select,0,strlen($select)-1);

        foreach ($daterange as $date) {
            $select2 .= "SUM(IF(DATE_FORMAT(data,'%Y-%m-%d') = '{$date->format('Y-m-d')}',total,0)) AS '{$date->format('d-m-Y')}',";
        }
        $select2 = substr($select2,0,strlen($select2)-1);

        //var_dump($select);
        //var_dump($select2);
        $sql = 'select '.$select.' from ( select  nomeRede,'.$select2.' from  QtdDiscipulosRede group by redeId) as q';
//        echo $sql;

            $pdo = new \PDO(DSN,USER,PASSWD);

            $stm = $pdo->prepare($sql);
            //$stm->bindParam(1,$);

            $stm->execute();

            return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function crescimentoStatus($inicio,$fim,$status)
    {
        $begin = new \DateTime( $inicio );
        $end = new \DateTime( $fim );
       // $end = $end->modify( '+1 day' );

        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($begin, $interval ,$end);
        //var_dump($daterange);
        $select='';
        $select2='';

        foreach ($daterange as $date) {
            $select .= "q.`{$date->format('d-m-Y')}`,";
        }
        $select = substr($select,0,strlen($select)-1);

        foreach ($daterange as $date) {
            $select2 .= "SUM(IF(DATE_FORMAT(data,'%Y-%m-%d') = '{$date->format('Y-m-d')}',quantidade,0)) AS '{$date->format('d-m-Y')}',";
        }
        $select2 = substr($select2,0,strlen($select2)-1);

        //var_dump($select);
        //var_dump($select2);
        $sql = 'select '.$select.' from ( select  '.$select2.' from  QtdDiscipuloStatus where tipoStatusId = '.$status.' ) as q';
        //echo $sql;
        //exit;

            $pdo = new \PDO(DSN,USER,PASSWD);

            $stm = $pdo->prepare($sql);
            //$stm->bindParam(1,$);

            $stm->execute();

            return $stm->fetch(\PDO::FETCH_ASSOC);
    }


}
