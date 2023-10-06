<?php
    // require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/test/AFile.php';
    // require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/test/BFile.php';

    spl_autoload_register(function ($class){

        require_once $class.'.php';
    
    });
    use testA as tA;
    tA\readMe();