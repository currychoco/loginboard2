<?php
    use dao\User;

    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $utility = new Utility();
    $dao = new User();

    $id = $utility->filter_SQL( $_GET['userId']);
    
    $result = $dao->idCheck($id);
    
    $data = null;
    if($result) {
        $data = array('count' => $result);
    }
    else {
        $data = array('count' => '9999');
    }

    echo json_encode($data);