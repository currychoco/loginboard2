<script src="/loginboard2/js/user/user.js"></script>
<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $utility = new Utility();
    $dao = new User();
    $user = array();

    $user['name'] = $utility->filter_SQL($_POST['name']);
    $user['phoneNumber'] = $utility->filter_SQL($_POST['phoneNumber']);
    $user['gender'] = $utility->filter_SQL($_POST['gender']);

    $user['no'] = $utility->filter_SQL($_SESSION['no']);
    $user['userId'] = $utility->filter_SQL($_SESSION['userId']);

    $result = $dao->updateUser($user);

    echo "<script>updateSuccess($result)</script>";