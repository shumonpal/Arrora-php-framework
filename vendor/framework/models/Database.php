<?php

namespace vendor\framework\models;

use PDO;
use App\Config;
/**
 * Model Class
 *
 * PHP version 7.0.27
 */
class Database
{

    /**
    * Get table
    */
 
    public static function DB()
    {
        static $db = null;
        if ($db === null) {
            $host     = Config::HOST_NAME;
            $database = Config::DB_NAME;
            $username = Config::DB_USER;
            $pass     = Config::DB_PASSWORD;

           
            $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $pass);
            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        }

        return $db;
    }


    

    
}
