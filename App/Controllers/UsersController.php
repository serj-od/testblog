<?php


namespace App\Controllers;

use App\Models\User;
use Core\View;

class UsersController
{
    public function __construct()
    {
    }

    public function showRegForm()
    {
        $v = new View();
        $title = " - Регистрация - ";
        $v->render("Users/regForm.tpl", compact(["title"]));
    }

    public function sendRegister()
    {
        $err = [];
        if (!isset($_POST["login"]) || mb_strlen($_POST["login"], 'UTF-8') < 3) {
            $err[] = "Bad login - min:3";
        }
        if (!isset($_POST["pass1"]) || mb_strlen($_POST["pass1"], 'UTF-8') < 5) {
            $err[] = "Bad pass1 - min:5";
        }
        if (!isset($_POST["pass2"]) || mb_strlen($_POST["pass2"], 'UTF-8') < 5) {
            $err[] = "Bad pass2 - min:5";
        }
        if ($_POST["pass1"] !== $_POST["pass2"]) {
            $err[] = "Pass1 != Pass2";
        }
        $v = new View();
        $title = " - Регистрация - ";
        if (count($err) > 0) {
            $v->render("Users/regForm.tpl", compact(["title", "err"]));
        } else {
            $u = new User([$_POST["login"], $_POST["pass1"]]);
            header('Location: /');
        }
    }

    public function showLogin()
    {
        $v = new View();
        $title = " - Вход - ";
        $v->render("Users/loginForm.tpl", compact(["title"]));
    }

    public function sendLogin()
    {
        $err = [];
        if (!isset($_POST["login"]) || mb_strlen($_POST["login"], 'UTF-8') < 3) {
            $err[] = "Bad login";
        }
        if (!isset($_POST["pass"]) || mb_strlen($_POST["pass"], 'UTF-8') < 5) {
            $err[] = "Bad pass";
        }

        $u = new User();
        $u->findByLogin($_POST["login"]);

        if (false === $u) $err[] = "User not found!";
        if (crypt($_POST["pass"], "testblog") !== $u->pass) $err[] = "Bad pass";

        $v = new View();
        $title = " - Вход - ";
        if (count($err) > 0) {
            $v->render("Users/loginForm.tpl", compact(["title", "err"]));
        } else {
            $_SESSION["user"] = $u;
            header('Location: /');
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        header('Location: /');
    }
}