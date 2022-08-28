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
class ConsolidacaoRedeSemanal extends ModeloFramework
{
    private $id;

    public function listarPorRedeData($id)
    {
        $pdo = self::pegarConexao();

        $sql = 'SELECT *
            FROM ConsolidacaoRedeSemanal WHERE tipoRedeId = ?';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $id);
        $stm->execute();

        $resposta = array();

        while ($obj = $stm->fetchObject('\Rede\Modelo\ConsolidacaoRedeSemanal')) {
            $resposta[$obj->data][$obj->id] = $obj;
        }

        return $resposta;
    }

    public function resumoRede($id)
    {
        $pdo = self::pegarConexao();

        $sql = '
            select tipoRedeId, tipoNome , count(tipoRedeId) as total, `data`
             from ConsolidacaoRedeSemanal
              where tipoRedeId = ?
            group by tipoRedeId, tipoNome, data, tipoRedeId
            order by data ASC
            ';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $id);
        $stm->execute();

        $resposta = array();

        while ($obj = $stm->fetchObject('\Rede\Modelo\ConsolidacaoRedeSemanal')) {
            $resposta[] = $obj;
        }
        return $resposta;
    }

    public function proximaDataRelatorio($tipoRedeId, $data)
    {
        $pdo = self::pegarConexao();

        $sql = "
            select data
            from  ConsolidacaoRedeSemanal
            WHERE
             tipoRedeId = ?
              and
             data > ?
            group by data
            limit 1
            ";

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $tipoRedeId);
        $stm->bindParam(2, $data);
        $stm->execute();

        return $stm->fetchAll();
    }

    public function redePorData($tipoRedeId, $data)
    {
        $pdo = self::pegarConexao();

        $sql = '
                select *
                from ConsolidacaoRedeSemanal
                    WHERE tipoRedeId = ?
                and
                    data  = ?
            ';

        $stm = $pdo->prepare($sql);

        $stm->bindParam(1, $tipoRedeId);
        $stm->bindParam(2, $data);
        $stm->execute();

        $resposta = array();

        while ($obj = $stm->fetchObject('\Rede\Modelo\ConsolidacaoRedeSemanal')) {
            $resposta[$obj->discipuloId] = $obj;
        }
        return $resposta;
    }
}
