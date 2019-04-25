<?php

require_once __DIR__ . "/../autoload.php";

use Core\Router;

session_start();

try {
    $r = new Router;
    $r->run();

} catch (Exception $e) {
    echo $e->getMessage();
}
