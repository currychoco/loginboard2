<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';

    spl_autoload_register(function($className) {

        $dirs = array(
            DAO_PATH . '/admin/',
            DAO_PATH . '/board/',
            DAO_PATH . '/comment/',
            DAO_PATH . '/user/',
            ROOT_PATH . '/common/'
        );

        foreach($dirs as $dir) {

            $tmp = explode("\\", $className);
            $name = end($tmp);

            if(file_exists($dir . $name . '.DAO.php')) {
                require_once($dir . $name . '.DAO.php');
                return;
            }

            if(file_exists($dir . $name . '.php')) {
                require_once($dir . $name . '.php');
                return;
            }
        }
    });