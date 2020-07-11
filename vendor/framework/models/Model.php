<?php

namespace vendor\framework\models;

use vendor\framework\models\Database;
use PDO;
/**
 * Model Class
 *
 * PHP version 7.0.27
 */
abstract class Model
{

    protected static $db;

    public function __construct()
    {
        self::$db = Database::DB();
    }

    /**
    * lists query from table  
    *
    * @return mixed
    */

    public static function lists()
    {
        $table = static::table();
        $query = self::$db->query("SELECT * FROM $table 
                                ORDER BY created_at");
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }


    /**
    * lists query from table by colume name
    *
    * @return mixed
    */
    public static function listsBy($colume = [])
    {
        $table = static::table();
        $colume = implode(',', $colume);
        $query = self::$db->query(" SELECT $colume FROM $table ");
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    /**
    * query from table by id
    *
    * @return mixed
    */
    public static function where($colume, $value)
    {
        $table = static::table();
        $query = self::$db->query(" SELECT * FROM $table WHERE $colume = $value");
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }


    /**
    * query all from table  
    *
    * @return mixed
    */
    public static function insert($data = ['name' => 'insert test', 'discribe' => 'insert test' ])
    {
        $table = static::table();
        $keys = implode(',', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $query = self::$db->prepare(" INSERT INTO $table($keys) VALUES($values) ");

        foreach ($data as $keys => $values) {
            $query->bindParam(":$keys", $values);
        }

        return $query->execute();
    }



    
}
