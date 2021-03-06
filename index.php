<?php
    session_start();
    mb_internal_encoding("UTF-8");

    function classAutoloader($class) {
        if (preg_match('/Controller$/', $class)) {
            require_once('controllers/' . $class . '.php');
        } else {
            require_once('models/' . $class . '.php');
        }
    }

    spl_autoload_register("classAutoloader");

    Dbh_static::connect();
    
    $router = new RouterController();
    // $router->go(array($_SERVER['REQUEST_URI']));
    $router->go();
    $router->renderView();
?>