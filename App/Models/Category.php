<?php 

namespace App\Models;

use vendor\framework\models\Model;
use PDO;
/**
* Category model
*/
class Category extends Model
{
    
    /**
     * assign table name for query
     *
     * @return table
     */
    public static function table()
    {
        return "categories";
    }

    /**
     * Get all the posts as an associative array
     *
     * @return array
     */
    public function getAll()
    {
        return static::lists();
    }
}