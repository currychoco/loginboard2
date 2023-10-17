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

            if(file_exists($dir . $className . '.DAO.php')) {
                require_once($dir . $className . '.DAO.php');
                return;
            }

            if(file_exists($dir . $className . '.php')) {
                require_once($dir . $className . '.php');
                return;
            }
        }
    });