<?php
    use dao\Comment;
    
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';
    
    $utility = new Utility();
    $dao = new Comment();

    // 로그인 체크
    $login = false;
    $user;
    if(isset($_SESSION['userId']) && isset($_SESSION['no'])) {
        $user = $utility->checkLogin($_SESSION['userId'], $_SESSION['no']);
    }
    else {
        echo json_encode(array('result' => false, 'msg' => '로그인이 필요합니다.'));
        exit;
    }

    $boardId = $utility->filter_SQL($_POST['boardId']);
    $commentContent = $_POST['comment'];

    $parentId = null;
    if(isset($_POST['parentId'])) {
        $parentId = $utility->filter_SQL($_POST['parentId']);
    }

    $comment = array(
        'boardId' => $boardId,
        'userNo' => $user['no'],
        'comment' => $commentContent,
        'parentId' => $parentId
    );

    $result = $dao->createComment($comment);

    $resultMsg = null;
    if($result) {
        $resultMsg = '성공';
    }
    else {
        $resultMsg = '댓글 작성에 실패하였습니다.';
    }

    $response = array('result' => $result, 'msg' => $resultMsg);
    echo json_encode($response);