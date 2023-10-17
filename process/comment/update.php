<?php
    session_start();    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $utility = new Utility();
    $dao = new Comment();

    $commentId = $utility->filter_SQL($_POST['commentId']);
    $result = false;
    $commentVal = $_POST['comment'];

    // 로그인 체크
    $user = null;
    if(isset($_SESSION['userId']) && isset($_SESSION['no'])) {
        $user = $utility->checkLogin($_SESSION['userId'], $_SESSION['no']);  
    }

    if(strlen($commentVal) < 2 || strlen($commentVal) > 255) {
        $msg = '댓글은 2자 이상, 255자 이하만 가능합니다.';
        echo json_encode(array('result' => $result, 'msg' => $msg));
        exit;
    }

    $originalComment = $dao->getCommentById($commentId);

    if($originalComment['user_no'] != $user['no']) {
        $msg = '본인이 작성한 댓글만 수정 가능합니다.';
        echo json_encode(array('result' => $result, 'msg' => $msg));
        exit;
    }
    else {

        $comment = array(
            'comment' => $commentVal,
            'id' => $commentId
        );

        $result = $dao->updateCommentById($comment);

        if($result) {
            $msg = '성공';
            echo json_encode(array('result' => $result, 'msg' => $msg));
        }
        else {
            $msg = '댓글 수정에 실패하였습니다.';
            echo json_encode(array('result' => $result, 'msg' => $msg));
        }
    }
    