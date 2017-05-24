<?php


namespace App;


class Db
{
    use Singleton;

    protected $dbh;
    protected $config;

    /**
     * Db constructor.Соединение с базой данных
     */
    protected function __construct()
    {
        $this->config = Config::instance();

        $this->dbh = new \PDO ("mysql:host={$this->config->host};dbname={$this->config->dbname}", $this->config->login, $this->config->password, $this->config->options);

        if (!$this->dbh) {
            $e = new \App\Exceptions\Db('Не удалось подключиться к базе данных');
            throw $e;
        }
        $this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

    }

    public function execute($sql, $options = [])
    {

        $sth = $this->dbh->prepare($sql);
        if (!$sth->execute($options)) {
            $e = new \App\Exceptions\Db('Метод Execute не доступен');
            throw $e;
        }

        return true;
    }

    public function query($sql, $options = [], $class = 'stdClass')
    {

        $sth = $this->dbh->prepare($sql);

        if (false == $sth) {
            throw new \App\Exceptions\Db('Ошибка в запросе метода query');
        }

        $res = $sth->execute($options);

        if (false !== $res) {
            $result = $sth->fetchAll(\PDO::FETCH_CLASS, $class);
            if (false == $result) {
                throw new \App\Exceptions\Db('Метод Query не доступен');
            }
            return $result;//
        }

        return [];

    }

    public function queryEach($sql, $options = [], $class = 'stdClass')
    {

        $sth = $this->dbh->prepare($sql);
        if (false == $sth) {
            throw new \App\Exceptions\Db('Ошибка в запросе метода queryEach');
        }
        $sth->setFetchMode(\PDO::FETCH_CLASS, $class);

        $res = $sth->execute($options);

        if (false !== $res) {
            while ($result = $sth->fetch()) {
                yield $result;
            }
        } else {
            throw new \App\Exceptions\Db('Метод QueryEach не доступен');
        }
    }

    public function lastId()
    {
        return $this->dbh->lastInsertId();
    }
}
