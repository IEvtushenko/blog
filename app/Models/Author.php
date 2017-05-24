<?php


namespace App\Models;


use App\Model;

class Author extends Model implements \ArrayAccess
{
    const TABLE = 'authors';

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

}