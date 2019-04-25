<?php

namespace App\Models;

use Core\Model;
use PDOException;
use Exception;

class Post extends Model
{
    public $id;
    public $title;
    public $text;
    public $user;
    public $date;

    public $all = [];

    public function __construct(array $n = [])
    {
        parent::__construct();

        if (!empty($n) && count($n) == 4) {
            $this->insert(...$n);
        }
    }

    public function find($id)
    {
        try {
            $d = $this->db->prepare('select * from posts where id = ?');
            $d->execute([$id]);
            $r = $d->fetchAll();
            if (0 != count($r)) {
                $this->id = $r[0]["id"];
                $this->title = $r[0]["title"];
                $this->text = $r[0]["content"];
                $this->user = (new User())->find($r[0]["user_id"]);
                $this->date = $r[0]["created_date"];
                return $this;

            } else return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAll()
    {
        try {
            $d = $this->db->prepare('select * from posts');
            $d->execute();
            $r = $d->fetchAll();
            foreach ($r as $k => $v) {
                $tmp = new Post();
                $tmp->id = $v["id"];
                $tmp->title = $v["title"];
                $tmp->text = $v["content"];
                $tmp->user = (new User())->find($v["user_id"]);
                $tmp->date = $v["created_date"];
                $this->all[] = $tmp;
                $tmp = null;
            }
            return $this->all;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert($title, $content, $user_id, $created_date)
    {
        try {
            $d = $this->db->prepare('INSERT INTO posts (title,content,user_id,created_date) VALUES(?,?,?,?)');
            $d->execute([$title, $content, $user_id, $created_date]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $d = $this->db->prepare('delete from posts where id = ?');
            $d->execute([$id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function save()
    {
        try {
            $d = $this->db->prepare('update posts set title = ?, content = ?, user_id = ?, created_date = ? where id = ?');
            $d->execute([$this->title, $this->text, $this->user->id, date('Y-m-d H:i:s'), $this->id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}