<?php

namespace Core;

use Exception;

class Router
{
    private $routes = [];
    private $uri = '';
    private $restrict = [];


    public function __construct()
    {
        $this->routes = (new Config)->getRoutes();
        $this->restrict = (new Config)->getRestrictedMethods();
        $this->uri = trim($_SERVER['REQUEST_URI'], '/');
    }

    public function run()
    {

        foreach ($this->routes as $uri_pattern => $uri_action) {
            if (preg_match("#$uri_pattern#", $this->uri)) {
                // 1 - CT name, 2 - action, other - args
                $build_full_path = preg_replace("#$uri_pattern#", $uri_action, $this->uri);
                $tmp = explode('/', $build_full_path);
                if (isset($_SESSION["user"]) && $_SESSION["user"] instanceof Model) {

                }

                $controller = '\\App\\Controllers\\' . ucfirst(array_shift($tmp)) . 'Controller';
                $action = array_shift($tmp);
                try {
                    if (class_exists($controller)) {
                        $obj = new $controller;
                        if (method_exists($obj, $action))  {
                            if (in_array($action,$this->restrict) && !(isset($_SESSION["user"]) && $_SESSION["user"] instanceof Model)) throw new Exception("Please login");
                            $obj->$action(...$tmp);
                        }
                        else  throw new Exception("Class $controller, method $action not found ");
                    } else throw new Exception("Class $controller not found");
                } catch (Exception $e) {
                    $v = new View();
                    $title = "404";
                    $v->render("System/404.tpl", compact(['title', "e"]));
                }
                break;
            }

        }
    }

}