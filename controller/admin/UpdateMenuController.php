<?php
    use dao\Category;
    use dao\Menu;
    
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $utility = new Utility();
    $menuDao = new Menu();
    $categoryDao = new Category();

    // 관리자 아닐 경우 게시판 리스트로
    if($_SESSION['user'] != 'admin') {
        echo ("
            <script>
                location.href = '/loginboard2/controller/board/BoardListController.php';
            </script>
        ");
    }

    $type = 'read';
    if(isset($_GET['type'])) {
        $type = $utility->filter_SQL($_GET['type']);
    }
    
    $menuId = $utility->filter_SQL($_GET['menuId']);

    $menu = $menuDao->getMenuById($menuId);

    $categoryList = $categoryDao->getCategoryList();

    $oTemplate = new Template();

    $oTemplate->set('menu', $menu);
    $oTemplate->set('categoryList', $categoryList);


    if($type == 'read') {
        $templateType = ROOT_PATH . "/tpl/admin/readMenu.tpl.php";
    }
    else if($type == 'update') {
        $templateType = ROOT_PATH . "/tpl/admin/updateMenu.tpl.php";
    }
    

    echo $oTemplate->fetch($templateType);