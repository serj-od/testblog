<?php

namespace App\Controllers;

use App\Models\Post;
use Core\Controller;
use Core\View;


class PostsController extends Controller
{
    public function index()
    {
        $all = (new Post)->getAll();
        $v = new View();
        $title = "Список постов";
        $v->render("Posts/index.tpl", compact(['title', 'all']));
    }

    public function show($id)
    {
        $post = new Post;
        $post->find($id);
        $v = new View();
        $title = "Пост - " . $post->title;
        $v->render("Posts/show.tpl", compact(["id", 'title', 'post']));
    }

    public function delete($id)
    {
        $post = new Post;
        $post->delete($id);
        header('Location: /');
    }

    public function edit($id)
    {
        $post = new Post;
        $post->find($id);
        $v = new View();
        $title = " - РЕДАКТИРОВАНИЕ - ";
        $v->render("Posts/edit.tpl", compact(["id", 'title', 'post']));
    }

    public function save($id)
    {
        $err = [];
        if (!isset($_POST["title"]) || mb_strlen($_POST["title"], 'UTF-8') < 10) {
            $err[] = "Bad title";
        }
        if (!isset($_POST["content"]) || mb_strlen($_POST["content"], 'UTF-8') < 10) {
            $err[] = "Bad content";
        }

        $post = new Post;
        $post->find($id);

        $v = new View();
        $title = " - РЕДАКТИРОВАНИЕ - ";
        if (count($err) > 0) {
            $v->render("Posts/edit.tpl", compact(["id", 'title', 'post', 'err']));
        } else {
            $post->title = trim($_POST["title"]);
            $post->text = trim($_POST["content"]);
            $post->save();
            header('Location: /posts/');
        }
    }

    public function add()
    {
        $v = new View();
        $title = " - НОВЫЙ ПОСТ - ";
        $v->render("Posts/new.tpl", compact(['title']));
    }

    public function newPost()
    {
        $err = [];
        if (!isset($_POST["title"]) || mb_strlen($_POST["title"], 'UTF-8') < 10) {
            $err[] = "Bad title";
        }
        if (!isset($_POST["content"]) || mb_strlen($_POST["content"], 'UTF-8') < 10) {
            $err[] = "Bad content";
        }

        $v = new View();
        $title = " - НОВЫЙ ПОСТ - ";
        if (count($err) > 0) {
            $v->render("Posts/new.tpl", compact(['title', 'err']));
        } else {
            new Post([
                trim($_POST["title"]),
                trim($_POST["content"]),
                $_SESSION["user"]->id,
                date('Y-m-d H:i:s')]);
            header('Location: /posts/');
        }

    }

}