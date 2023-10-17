<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    if($_SESSION['user'] != 'admin') {
        echo json_encode(array('result' => -2, 'msg' => '관리자 권한이 필요합니다.'));
        exit;
    }

    $utility = new Utility();

    $categoryId = $utility->filter_SQL($_POST['categoryId']);
    $name = $utility->filter_SQL($_POST['name']);
    $content = $utility->filter_SQL($_POST['content']);

    if(strlen($name) < 2 || strlen($name) > 20) {
        echo json_encode(array('result' => -3, 'msg' => '메뉴명을 확인해 주세요.'));
        exit;
    }

    if(strlen($content) > 100) {
        echo json_encode(array('result' => -3, 'msg' => '메뉴 설명을 확인해 주세요.'));
        exit;
    }

    $category = array(
        'id' => $categoryId,
        'name' => $name,
        'content' => $content
    );

    $dao = new Category();
    $result = $dao->updateCategoryById($category);

    if($result) {
        echo json_encode(array('result' => 1, 'msg' => '카테고리 수정 성공'));
    }
    else {
        echo json_encode(array('result' => -1, 'msg' => '카테고리 수정에 실패하였습니다.'));
    }