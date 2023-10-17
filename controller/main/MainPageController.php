<?php
    session_start();
    ini_set('display_errors', 1);

    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $categoryDao = new Category();
    $menuDao = new Menu();

    $categoryList = $categoryDao->getCategoryList();
    $menuList = $menuDao->getMenuList();

    $filename = ROOT_PATH . '/cache.php';

    if(!file_exists($filename) || filemtime($filename) + CACHE_TIME < time()) {
        require_once ROOT_PATH . '/process/main/createCacheFile.php';
    }
   
    $fp = fopen($filename, 'r');
    $list = '';

    while(!feof($fp)) {
        $list .= fgets($fp);
    }

    $mainBoardList = (array)json_decode($list);

    $oTemplate = new Template();
    
    $oTemplate->set('categoryList', $categoryList);
    $oTemplate->set('menuList', $menuList);
    $oTemplate->set('mainBoardList', $mainBoardList);

    $templateType = ROOT_PATH . '/tpl/main/mainPageView.tpl.php';

    echo $oTemplate->fetch($templateType);