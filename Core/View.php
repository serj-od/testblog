<?php

namespace Core;

use Exception;

class View
{
    public function __construct()
    {

    }

    public function render(string $template, array $data)
    {
        $dir = (new Config())->getTemplatesDir() . "/";
        if (!file_exists($dir . $template)) throw new Exception(__FILE__ . " $template - not found!");
        extract($data);
        ob_start();
        include $dir . $template;
        echo ob_get_clean();
    }

}