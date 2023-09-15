<script src="/loginboard2/js/user/user.js"></script>
<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT']."/loginboard2/conf.php";
    require_once DAO_PATH . '/user/User.DAO.php';
    require_once ROOT_PATH . '/common/Utility.php';

    $utility = new Utility();
    $dao = new UserDAO();

    $id = $utility->filter_SQL($_POST['userId']);
    $tempPw = $utility->filter_SQL($_POST['password']);
    $pw = hash("sha256", $tempPw);

    $result = $dao->getUserIdAndPw($id, $pw);

    if(empty($result)){
        echo '<script>isNotId()</script>';
        exit;
    }

    if($result['password'] != $pw){
        echo '<script>notEqualPw()</script>';
        exit;
    }

    // 세션 추가
    $_SESSION['userId'] = $result['user_id'];
    $_SESSION['no'] = $result['no'];

    echo '<script>login()</script>';