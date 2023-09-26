<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/Template.php';
    require_once ROOT_PATH . '/common/Utility.php';
    require_once DAO_PATH . '/comment/Comment.DAO.php';

    $utility = new Utility();
    $dao = new Comment();
    $oTemplate = new Template();

    // 로그인 체크
    $user = null;
    if(isset($_SESSION['userId']) && isset($_SESSION['no'])) {
        $user = $utility->checkLogin($_SESSION['userId'], $_SESSION['no']);
    }

    $commentId = $utility->filter_SQL($_POST['commentId']);

    $list = $dao->getAnswerList($commentId);

    $oTemplate->set('listResult', $list);
    $oTemplate->set('user', $user);
    $oTemplate->set('commentId', $commentId);

    $templateType = ROOT_PATH . '/tpl/comment/answerList.tpl.php';

    echo $oTemplate->fetch($templateType);
