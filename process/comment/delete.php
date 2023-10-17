<?php
    use dao\Comment;
    
    session_start();    
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $utility = new Utility();
    $dao = new Comment();
    $result = false;

    $commentId = $utility->filter_SQL($_POST['commentId']);

    $originalComment = $dao->getCommentById($commentId);

    // 로그인 체크
    $user = null;
    if(isset($_SESSION['userId']) && isset($_SESSION['no'])) {
        $user = $utility->checkLogin($_SESSION['userId'], $_SESSION['no']);  
    }

    if($originalComment['user_no'] != $user['no']) {
        $msg = '본인이 작성한 댓글만 삭제 가능합니다.';
        echo json_encode(array('result' => $result, 'msg' => $msg));
        exit;
    }

    $result = $dao->deleteCommentById($commentId);

    if($result) {
        $msg = '성공';
        echo json_encode(array('result' => $result, 'msg' => $msg));
    }
    else {
        $msg = '댓글 삭제에 실패하였습니다';
        echo json_encode(array('result' => $result, 'msg' => $msg));
    }