<?php
    session_start();
    ini_set('display_errors', 1);

    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $utility = new Utility();
    $categoryDao = new Category();

    // 로그인 체크
    $login = false;
    $user;
    if(isset($_SESSION['userId']) && isset($_SESSION['no'])) {
        $user = $utility->checkLogin($_SESSION['userId'], $_SESSION['no']);
        
        if(!empty($user)) {
            $login = true;
        }
       
    }

    // 게시글 번호 체크
    $no = 0;
    if(isset($_GET['no']) && $_GET['no'] > 0) {
        $no = $utility->filter_SQL($_GET['no']);
    }

    $search = '';
    if(isset($_GET['search'])) {
        $search = $utility->filter_SQL($_GET['search']);
    }

    $keyword = '';
    if(isset($_GET['keyword'])) {
        $keyword = $utility->filter_SQL($_GET['keyword']);
    }

    $urlMenuId = 2;
    if(isset($_GET['menu'])) {
        $urlMenuId = $utility->filter_SQL($_GET['menu']);
    }  

    $urlCategoryId = 5;
    if(isset($_GET['category'])) {
        $categoryId = $utility->filter_SQL($_GET['category']);
    }

    $categoryList = $categoryDao->getCategoryList();

    $oTemplate = new Template();

    $oTemplate->set('checkLogin', $login);
    $oTemplate->set('no', $no);
    $oTemplate->set('search', $search);
    $oTemplate->set('keyword', $keyword);
    $oTemplate->set('categoryList', $categoryList);
    $oTemplate->set('urlCategoryId', $urlCategoryId);
    $oTemplate->set('urlMenuId', $urlMenuId);

    $templateType = ROOT_PATH . '/tpl/board/boardWriteView.tpl.php';

    echo $oTemplate->fetch($templateType);