<?php
    session_start();
    ini_set('display_errors', 1);

    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/Template.php';
    require_once ROOT_PATH . '/common/Utility.php';
    require_once DAO_PATH . '/board/DanawaBoardList.DAO.php';
    require_once DAO_PATH . '/admin/Category.DAO.php';
    require_once DAO_PATH . '/admin/Menu.DAO.php';

    $categoryDao = new CategoryDAO();
    $menuDao = new MenuDAO();

    $categoryList = $categoryDao->getCategoryList();
    $menuList = $menuDao->getMenuList();

    $filename = ROOT_PATH . '/cache.php';
    $fp = fopen($filename, 'r');
    $list = '';

    while(!feof($fp)) {
        $list .= fgets($fp);
    }

    $boardList = (array)json_decode($list);

    $oTemplate = new Template();
    
    $oTemplate->set('categoryList', $categoryList);
    $oTemplate->set('menuList', $menuList);
    $oTemplate->set('boardList', $boardList);

    $templateType = ROOT_PATH . '/tpl/main/mainPageView.tpl.php';

    echo $oTemplate->fetch($templateType);