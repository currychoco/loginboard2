<?php
    use dao\User;
    
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $utility = new Utility();
    $dao = new User();
    $user = array();

    $tempPw = $utility->filter_SQL($_POST['password']);
    $user['pw'] = hash("sha256", $tempPw);
    $user['name'] = $utility->filter_SQL($_POST['name']);
    $user['userId'] = $utility->filter_SQL($_POST['userId']);
    $user['phoneNumber'] = $utility->filter_SQL($_POST['phoneNumber']);
    $user['gender'] = $utility->filter_SQL($_POST['gender']);
    
    $result = $dao->setUser($user);
    $data = array('result'=>$result);

    echo json_encode($data);