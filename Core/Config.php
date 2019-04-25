<?php

namespace Core;

use Exception;

class Config
{
    private $mysql;
    private $routes = [];
    private $root_dir = '';
    private $template_dir = '';

    public function __construct()
    {
        if (file_exists(__DIR__ . '/../App/config.php')) {
            $c = include __DIR__ . '/../App/config.php';
            if (!key_exists('routes', $c)) throw new Exception("can't find routes");
            else $this->routes = $c['routes'];
            $this->template_dir = $c['template_dir'];
            $this->mysql = $c['mysql'];
            $this->restrict = $c['restrict'];
        } else throw new Exception("config.php not found");

        $this->root_dir = __DIR__ . '/../App';
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getMysql()
    {
        return $this->mysql;
    }

    public function getRoot()
    {
        return $this->root_dir;
    }

    public function getTemplatesDir()
    {
        return $this->root_dir . "/" . $this->template_dir;
    }
    public function getRestrictedMethods()
    {
        return $this->restrict;
    }
}