<?php

namespace framework\modelo ;
use PDO ;

class modeloFramework
{
    private static $con = false ;

    public function __construct(){}

    public static function criarConexao()
    {
        $options = array( \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);

        if (false === self::$con) {
        self::$con = new \PDO(DSN, USER, PASSWD, $options);
      }

  return self::$con;
    }

    public static function pegarConexao()
    {
        return self::criarConexao() ;

    }

     /**@todo
     * Perform an INSERT statement
     */
    public static function insert($data)
    {
                $reflect = new \ReflectionClass($data);
                $class = ucfirst ($reflect->getShortName());
                $props   = $reflect->getProperties();

                $values = array();
                $fields = array();
                $numFields = '';
                $map = array();

                foreach ($props as $d) {
                    $prop = $d->name;
                        if ($data->$prop) {
                            $fields = $d->name;
                            $values = $data->$prop;
                            $map[$fields] = $values;
                    }
                }

                $numFields = count($map);
                $num = 0;

                $fields = '';
                $values = '';
                $int = '';
                foreach ($map as $k => $v) {
                    ++$num;
                    $fields .= ($num < $numFields ) ? $k.', ' : $k ;
                    $values .= ($num < $numFields ) ? $v.', ' : $v ;
                    $int[] = ':'.$k ;
                }

                $int = implode(',',$int);

                $pdo = self::pegarConexao();

                $sql = 'INSERT INTO '.$class.' ('.$fields.') VALUES ('.$int.')';
              $stm = $pdo->prepare($sql);

                foreach ($map as $k => $v) {
                                $parameter = ':'.$k;
                                $stm->bindValue($parameter, $v , \PDO::PARAM_STR);
                }

              $stm->execute();
                var_dump($stm->debugDumpParams());

                var_dump($stm->errorInfo());

        return $pdo->lastInsertId();

    }

    public static function delete($data)
    {
                $id = $data->id;
                $reflect = new \ReflectionClass($data);
                $class = ucfirst ($reflect->getShortName());
                $props   = $reflect->getProperties();

                $pdo = self::pegarConexao();

                $sql = 'DELETE FROM '.$class.' WHERE id  = ? ' ;
              $stm = $pdo->prepare($sql);

                $stm->bindParam(1, $id , PDO::PARAM_INT);

              $stm->execute();
                //var_dump($stm->debugDumpParams());

                //var_dump($stm->errorInfo()); die();
        return $pdo->lastInsertId();

    }

}
