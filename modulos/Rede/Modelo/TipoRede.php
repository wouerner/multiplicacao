<?php
/**
 * tipoRede
 *
 * @uses modeloFramework
 * @author wouerner <wouerner@gmail.com>
 */

namespace Rede\Modelo;

use \Framework\Modelo\ModeloFramework;
use \Metas\Modelo\Metas as Metas;
class TipoRede extends ModeloFramework
{
    private $id;
    private $nome;
    private $erro;

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __set($prop, $valor)
    {
        $this->$prop = $valor;
    }

    public function getMeta()
    {
        $meta = new Metas();
        $meta->tipoRedeId = $this->id;
        $meta = $meta->metaPorRede();

        return $meta[0];
    }

    public function salvar()
    {
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
        $pdo = null;

        return $resposta;
    }

    public function salvarTipoRedeDiscipulo()
    {
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

        $pdo = null;

        return $resposta;
    }

    public function listarTodos()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM TipoRede';

        $stm = $pdo->prepare($sql);

        $stm->execute();

        $resposta = array();

        while ($obj = $stm->fetchObject('\Rede\Modelo\TipoRede')) {
            $resposta[$obj->id] = $obj;
        }

        return $resposta;
    }

    public function totalDiscipulosPorRede()
    {
        $pdo = self::pegarConexao();

        $sql ='
                SELECT count(*) FROM Discipulo as d
                inner join Redes as r on d.id = r.discipuloId and d.ativo = 1
                WHERE r.tipoRedeId = ?
                ';

        $stm = $pdo->prepare($sql);
        $id = $this->id;

        $stm->bindParam(1, $id);

        $stm->execute();
        $resposta = $stm->fetch();

        $pdo = null;

        return $resposta[0];
    }

    public function listarUm()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM TipoRede WHERE id = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();

        return $stm->fetchObject();
    }

    public function listarCelulas()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT * FROM Celula WHERE tipoRedeId = ? order by Celula.nome';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();
        $resposta = array();

        while ($obj = $stm->fetchObject('\celula\modelo\celula')) {
            $resposta[$obj->id] = $obj;
        }

        return $resposta;
    }

    public function listarCelulasTotal()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT COUNT(*) AS total FROM Celula WHERE tipoRedeId = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();

        $resposta = $stm->fetch();

        return $resposta[0];
    }

    public function totalCelulasMultiplicacao()
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT COUNT(*) AS total FROM Celula WHERE tipoRedeId = ? and multiplicacao = 1 and ativa =1';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();

        $resposta = $stm->fetch();

        return $resposta[0];
    }

    public function atualizar()
    {
        $pdo = self::pegarConexao();
        $sql = " UPDATE TipoRede SET 	nome = ?
            WHERE id = ? ";
        $stm = $pdo->prepare($sql);
        $stm->bindParam(1, $this->nome);
        $stm->bindParam(2, $this->id);

        $resposta = $stm->execute();

        $pdo = null;

        return $resposta;

    }

    public function excluir()
    {
        try {
            $pdo = self::pegarConexao();

            $sql = 'DELETE FROM TipoRede WHERE id = ?';

            $stm = $pdo->prepare($sql);

            $stm->bindParam(1, $this->id);

            $resposta = $stm->execute();
            $erro = $stm->errorCode();

            if ($erro != '0000') {
                 throw new \Exception('Existe discípulos cadastrados');
            }
        } catch ( \Exception $e ) {
            $this->erro= $e->getMessage();
        }
    }

    public function crescimento($inicio, $fim)
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
            $select2 .= "SUM(IF(DATE_FORMAT(data,'%Y-%m-%d') = '{$date->format('Y-m-d')}',total,0)) AS '{$date->format('d-m-Y')}',";
        }
        $select2 = substr($select2,0,strlen($select2)-1);

        //var_dump($select);
        //var_dump($select2);
        $sql = 'select '.$select.' from ( select  '.$select2.' from  QtdDiscipulosRede where redeId = '.$this->id.') as q';
        //echo $sql;
        //exit;

            $pdo = new \PDO(DSN,USER,PASSWD);

            $stm = $pdo->prepare($sql);

            $stm->execute();

            return $stm->fetch(\PDO::FETCH_ASSOC);
            //return $stm->fetchAll();
    }

    public function lideresRede()
    {
        $pdo = self::pegarConexao();

        $sql = '
            select * from FuncaoRede fr
            join Redes as r ON r.funcaoRedeId = fr.id
            where fr.liderRede = 1 and r.tipoRedeId = ?
            ';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $this->id);

        $stm->execute();

        $resposta = array();
        $resposta = $stm->fetchAll();

        //while ($obj = $stm->fetchObject('\Rede\Modelo\TipoRede')) {
            //$resposta[$obj->id] = $obj;
        //}

        return $resposta;
    }
}
