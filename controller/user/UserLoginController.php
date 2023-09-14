<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT']."/loginboard2/conf.php";
    require_once ROOT_PATH . "/common/Utility.php";
    require_once ROOT_PATH . "/common/Template.php";

    // 로그인 체크
    $userId = null;

    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    }

    $oTemplate = new Template();

    $oTemplate->set("userId", $userId);

    $templateType = ROOT_PATH . '/tpl/user/userLoginView.tpl.php';

    echo $oTemplate->fetch($templateType);