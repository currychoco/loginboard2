<?php
    use dao\Category;
    use dao\Menu;
    
    session_start();
    ini_set('display_errors', 1);

    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    // 관리자 아닐 경우 게시판 리스트로
    if($_SESSION['user'] != 'admin') {
        echo ("
            <script>
                location.href = '/loginboard2/controller/board/BoardListController.php';
            </script>
        ");
    }

    $categoryDao = new Category();
    $categoryList = $categoryDao->getCategoryList();

    $menuDao = new Menu();
    $onlyMenuList = $menuDao->getOnlyMenuList();

    //생성자
    $oTemplate = new Template();

    //변수 셋팅
    $oTemplate->set('categoryList', $categoryList);
    $oTemplate->set('onlyMenuList', $onlyMenuList);

    //템플릿 위치 지정
	$templateType = ROOT_PATH . "/tpl/admin/createMenu.tpl.php";

    //패치
    echo $oTemplate->fetch($templateType);