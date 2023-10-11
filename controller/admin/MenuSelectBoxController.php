<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/loginboard2/conf.php";
    require_once ROOT_PATH . "/common/Template.php";
    require_once ROOT_PATH . "/common/Utility.php";
    require_once DAO_PATH . "/admin/Menu.DAO.php";

    $utility = new Utility();
    $dao = new MenuDAO();

    // 관리자 아닐 경우 게시판 리스트로
    if($_SESSION['user'] != 'admin') {
        echo ("
            <script>
                location.href = '/loginboard2/controller/board/BoardListController.php';
            </script>
        ");
    }

    $type = '0';
    if(isset($_POST['type']) && $_POST['type'] == 'onlyMenu') {
        $type = '1';
        $templateType = ROOT_PATH . '/tpl/admin/selectOnlyMenuList.tpl.php';
    }
    else {
        $templateType = ROOT_PATH . '/tpl/admin/selectMenuList.tpl.php';
    }
    
    $categoryId = $utility->filter_SQL($_POST['categoryId']);
    $menuList = $dao->getMenuListByCategoryId($categoryId, $type);

    $menuId = 0;
    if(isset($_POST['menuId'])){
        $menuId = $utility->filter_SQL($_POST['menuId']);
    }

    $oTemplate = new Template();

    $oTemplate->set('menuList', $menuList);
    $oTemplate->set('menuId', $menuId);
    
    echo $oTemplate->fetch($templateType);