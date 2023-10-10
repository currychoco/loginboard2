<?php
    session_start();
    ini_set('display_errors', 1);

    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/Template.php';
    require_once ROOT_PATH . '/common/Utility.php';
    require_once DAO_PATH . '/admin/Category.DAO.php';

    $utility = new Utility();
    $categoryDao = new CategoryDAO();

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

    $categoryList = $categoryDao->getCategoryList();

    $oTemplate = new Template();

    $oTemplate->set('checkLogin', $login);
    $oTemplate->set('no', $no);
    $oTemplate->set('categoryList', $categoryList);

    $templateType = ROOT_PATH . '/tpl/board/boardWriteView.tpl.php';

    echo $oTemplate->fetch($templateType);