<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/loginboard2/conf.php";
    require_once ROOT_PATH . "/common/Utility.php";
    require_once DAO_PATH . '/user/User.DAO.php';

    $utility = new Utility();
    $dao = new UserDAO();

    $id = $utility->filter_SQL( $_GET['userId']);
    
    $result = $dao->idCheck($id);
    
    if($result == 0) {
        // 해당 아이디가 없을 경우
        echo "1";
    }
    else {
        // 해당 아이디가 있을 경우
        echo "-1";
    }