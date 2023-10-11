<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/Utility.php';
    require_once DAO_PATH . '/admin/Menu.DAO.php';

    if($_SESSION['user'] != 'admin') {
        echo json_encode(array('result' => -2, 'msg' => '관리자 권한이 필요합니다.'));
        exit;
    }

    $utility = new Utility();

    $name = $utility->filter_SQL($_POST['name']);
    $content = $utility->filter_SQL($_POST['content']);
    $categoryId = $utility->filter_SQL($_POST['categoryId']);
    $visible = $utility->filter_SQL($_POST['visible']);
    $onlyMenu = $utility->filter_SQL($_POST['onlyMenu']);
    
    $parentId = 0;
    if(isset($_POST['menuId'])) {
        $parentId = $utility->filter_SQL($_POST['menuId']);
    }

    if(strlen($name) < 2 || strlen($name) > 20) {
        echo json_encode(array('result' => -3, 'msg' => '메뉴명을 확인해 주세요.'));
        exit;
    }

    if(strlen($content) > 100) {
        echo json_encode(array('result' => -3, 'msg' => '메뉴 설명을 확인해 주세요.'));
        exit;
    }

    $menu = array(
        'name' => $name,
        'content' => $content,
        'categoryId' => $categoryId,
        'visible' => $visible,
        'onlyMenu' => $onlyMenu,
        'parentId' => $parentId
    );

    $dao = new MenuDAO();
    $result = $dao->createMenu($menu);

    if($result) {
        echo json_encode(array('result' => 1, 'msg' => '메뉴 생성 성공'));
    }
    else {
        echo json_encode(array('result' => -1, 'msg' => '메뉴 생성에 실패하였습니다.'));
    }