<?php
    use dao\User;

    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $utility = new Utility();
    $dao = new User();

    $id = $utility->filter_SQL( $_GET['userId']);
    
    $result = $dao->idCheck($id);
    echo json_encode(array('count' => $result));