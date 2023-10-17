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

    $name = $utility->filter_SQL($_POST['name']);
    $content = $utility->filter_SQL($_POST['content']);

    $category = array(
        'name' => $name,
        'content' => $content
    );

    $dao = new Category();
    $result = $dao->createCategory($category);

    if($result) {
        echo json_encode(array('result' => 1, 'msg' => '카테고리 생성 성공'));
    }
    else {
        echo json_encode(array('result' => -1, 'msg' => '카테고리 생성에 실패하였습니다.'));
    }