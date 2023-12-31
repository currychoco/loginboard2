<?php
    use dao\Category;
    use dao\Menu;
    
    session_start();
    ini_set('display_errors', 1);
    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $categoryDao = new Category();
    $menuDao = new Menu();

    $categoryList = $categoryDao->getCategoryList();
    $menuList = $menuDao->getMenuList();

    //생성자
    $oTemplate = new Template();

    //변수 셋팅
	$oTemplate->set('categoryList', $categoryList);
    $oTemplate->set('menuList', $menuList);

    //템플릿 위치 지정
	$templateType = ROOT_PATH . "/tpl/header.tpl.php";

    //패치
    echo $oTemplate->fetch($templateType);