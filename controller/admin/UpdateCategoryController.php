<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . "/loginboard2/conf.php";
    require_once ROOT_PATH . "/common/Template.php";
    require_once ROOT_PATH . "/common/Utility.php";
    require_once DAO_PATH . "/admin/Category.DAO.php";

    $utility = new Utility();
    $dao = new Category();
    $oTemplate = new Template();

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

    $categoryId = $utility->filter_SQL($_GET['categoryId']);

    $category = $dao->getCategoryById($categoryId);

    $oTemplate->set('category', $category);

    if($type == 'read') {
        $templateType = ROOT_PATH . "/tpl/admin/readCategory.tpl.php";
    }
    else {
        $templateType = ROOT_PATH . "/tpl/admin/updateCategory.tpl.php";
    }
    
    echo $oTemplate->fetch($templateType);