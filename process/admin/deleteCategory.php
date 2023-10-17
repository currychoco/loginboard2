<?php
    use dao\Category;
    
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    if($_SESSION['user'] != 'admin') {
        echo json_encode(array('result' => -2, 'msg' => '관리자 권한이 필요합니다.'));
        exit;
    }

    $utility = new Utility();
    $dao = new Category();

    $categoryId = $utility->filter_SQL($_POST['categoryId']);

    $result = $dao->deleteCategoryById($categoryId);

    if(!$result) {
        echo json_encode(array('result' => $result, 'msg' => '카테고리 삭제 성공'));
    }
    else {
        echo json_encode(array('result' => $result, 'msg' => '카테고리 삭제에 실패하였습니다.'));
    }
