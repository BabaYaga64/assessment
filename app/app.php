<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/addressbook.php";

    $app = new Silex\Application();

    $app->get("/hello", function() {
        return "Hello friend!";
    });

    return $app;
?>