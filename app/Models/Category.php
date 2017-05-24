<?php

namespace App\Models;

use App\Db;
use App\Model;

class Category extends Model implements \ArrayAccess
{
    const TABLE = 'category';

    private $container = [];
    public $name;

    public function __construct()
    {
        $this['id'] = $this->id;
        $this['name'] = $this->name;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->container[$offset];
    }
    /**
     * Возвщает количество записей в нужной категории
     * @param $id
     * @return array
     */
    public static function totalNewsByCategoryId($id)
    {
        $db = Db::instance();
        $sql = "SELECT count(id) as count FROM news WHERE status = 1 AND category_id = ? ORDER BY id ";

        return $db->query($sql, array($id));
    }
}