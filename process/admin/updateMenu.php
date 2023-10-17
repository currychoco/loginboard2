<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    if($_SESSION['user'] != 'admin') {
        echo json_encode(array('result' => -2, 'msg' => '관리자 권한이 필요합니다.'));
        exit;
    }

    $utility = new Utility();
    $dao = new Menu();

    $id = $utility -> filter_SQL($_POST['id']);
    $menuId = $utility->filter_SQL($_POST['menuId']);
    $name = $utility->filter_SQL($_POST['name']);
    $content = $utility->filter_SQL($_POST['content']);
    $categoryId = $utility->filter_SQL($_POST['categoryId']);
    $onlyMenu = $utility->filter_SQL($_POST['onlyMenu']);
    $visible = $utility->filter_SQL($_POST['visible']);

    if(strlen($name) < 2 || strlen($name) > 20) {
        echo json_encode(array('result' => -3, 'msg' => '메뉴명을 확인해 주세요.' . $name));
        exit;
    }

    if(strlen($content) > 100) {
        echo json_encode(array('result' => -3, 'msg' => '메뉴 설명을 확인해 주세요.'));
        exit;
    }

    $parentId = 0;
    if(isset($_POST['menuId'])) {
        $parentId = $utility->filter_SQL($_POST['menuId']);
    }

    $depth = 0;
    if($parentId != 0) {
        $parent = $dao->getMenuById($parentId);
        $depth = $parent['depth'] + 1;
    }

    $menu = array(
        'id' => $id,
        'name' => $name,
        'content' => $content,
        'categoryId' => $categoryId,
        'onlyMenu' => $onlyMenu,
        'visible' => $visible,
        'depth' => $depth,
        'parentId' => $parentId
    );

    $result = $dao->updateMenuById($menu);

    if($result) {
        echo json_encode(array('result' => 1, 'msg' => '메뉴 수정 성공'));
    }
    else {
        echo json_encode(array('result' => -1, 'msg' => '메뉴 수정에 실패하였습니다.'));
    }