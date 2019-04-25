<?php


namespace App\Models;

use Core\Model;
use PDO;
use PDOException;

class User extends Model
{
    public $id;
    public $login;
    public $pass;
    public $all = [];

    public function __construct(array $n = [])
    {
        parent::__construct();

        if (!empty($n) && count($n) == 2) {
            $this->insert(...$n);
        }
    }

    public function insert($login, $pass)
    {
        try {
            $d = $this->db->prepare('INSERT INTO users (login,password) VALUES(?,?)');
            $d->execute([$login, crypt($pass, 'testblog')]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function find($id)
    {
        try {
            $d = $this->db->prepare('select * from users where id = ?');
            $d->execute([$id]);
            $r = $d->fetchAll();
            if (0 != count($r)) {
                $this->id = $r[0]["id"];
                $this->login = $r[0]["login"];
                $this->pass = $r[0]["password"];
                return $this;
            } else return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function findByLogin($login)
    {
        try {
            $d = $this->db->prepare('select * from users where login = ?');
            $d->execute([$login]);
            $r = $d->fetchAll();
            if (0 != count($r)) {
                $this->id = $r[0]["id"];
                $this->login = $r[0]["login"];
                $this->pass = $r[0]["password"];
                return $this;

            } else return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function __sleep()
    {
        return ["id", "login", "pass"];
    }

    public function __wakeup()
    {

    }

}