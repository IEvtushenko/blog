<?php


namespace App;


class Config 
{
    use Singleton;
    
    public $db_config = [];
    public $host;
    public $dbname;
    public $login;
    public $password;
    public $options;
    
    protected function __construct()
    {
        $db_config = include_once (ROOT . "/app/Config/db_config.php");
        $this->host = $db_config['host'];
        $this->dbname = $db_config['dbname'];
        $this->login = $db_config['login'];
        $this->password = $db_config['password'];
        $this->options = $db_config['options'];

    }
}