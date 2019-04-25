<?php


namespace Core;

use PDO;
use PDOException;

class Db

{
    private static $instance = null;
    private $dbh = null;

    private function __construct()
    {
        try {
            $c = new Config();
            $this->dbh = new PDO("mysql:host={$c->getMysql()['host']};dbname={$c->getMysql()['dbname']}", $c->getMysql()["user"], $c->getMysql()["password"]);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->exec("set names utf8");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->dbh;
    }

    private function __clone()
    {
    }


}