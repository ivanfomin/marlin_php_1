<?php


namespace Data;

class Db
{
    private $dbh;
    private static $connection;
//comment
    private function __construct()
    {
        $dsn = (include __DIR__ . '/../config.php')['database'];
        try {
            $this->dbh = new \PDO($dsn['connection'], $dsn['username'], $dsn['password'],
                [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
        } catch (\PDOException $exception) {
            var_dump($exception);
            die;
        }
    }

    public static function getInstance()
    {
        if (static::$connection === null) {
            static::$connection = new static();
        }
        return static::$connection;
    }

    public function execute(string $sql, array $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            var_dump($data);
            var_dump($sth);
            var_dump($sth->errorInfo());
            die;
        }
        return true;
    }

    public function query(string $sql, array $data = [], $class = null )
    {
        $sth = $this->dbh->prepare($sql);
    
        $sth->execute($data);
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}