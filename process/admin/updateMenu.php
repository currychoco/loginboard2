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

    $menuId = $utility->filter_SQL($_POST['menuId']);
    $name = $utility->filter_SQL($_POST['name']);
    $content = $utility->filter_SQL($_POST['content']);
    $categoryId = $utility->filter_SQL($_POST['categoryId']);
    $onlyMenu = $utility->filter_SQL($_POST['onlyMenu']);
    $visible = $utility->filter_SQL($_POST['visible']);

    if(strlen($name) < 2 || strlen($name) > 20) {
        echo json_encode(array('result' => -3, 'msg' => '메뉴명을 확인해 주세요.'));
        exit;
    }

    if(strlen($content) > 100) {
        echo json_encode(array('result' => -3, 'msg' => '메뉴 설명을 확인해 주세요.'));
        exit;
    }

    $menu = array(
        'id' => $menuId,
        'name' => $name,
        'content' => $content,
        'categoryId' => $categoryId,
        'onlyMenu' => $onlyMenu,
        'visible' => $visible
    );

    $dao = new MenuDAO();
    $result = $dao->updateMenuById($menu);

    if($result) {
        echo json_encode(array('result' => 1, 'msg' => '메뉴 수정 성공'));
    }
    else {
        echo json_encode(array('result' => -1, 'msg' => '메뉴 수정에 실패하였습니다.'));
    }