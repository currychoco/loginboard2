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

    $menuId = $utility->filter_SQL($_POST['menuId']);

    $result = $dao->deleteMenuById($menuId);

    if($result) {
        echo json_encode(array('result' => $result, 'msg' => '메뉴 삭제 성공'));
    }
    else {
        echo json_encode(array('result' => $result, 'msg' => '메뉴 삭제에 실패하였습니다.'));
    }
