<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $utility = new Utility();

    $id = $utility->filter_SQL( $_GET['userId']);
    
    $result = $dao->idCheck($id);
    
    $data = array('count'=>$result);

    echo json_encode($data);