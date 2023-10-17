<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';

    spl_autoload_register(function($className) {

        include ROOT_PATH . '/test/autoload/classes/' . $className . '.php';
    });