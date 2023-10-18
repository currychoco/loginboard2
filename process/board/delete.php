<?php
    use dao\DanawaBoardList;
    
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    $utility = new Utility();
    $dao = new DanawaBoardList();

    // 로그인 체크
    $login = false;
    $user;
    if(isset($_SESSION['userId']) && isset($_SESSION['no'])) {
        $user = $utility->checkLogin($_SESSION['userId'], $_SESSION['no']);
        
        if(!empty($user)) {
            $login = true;
        }
        
    }

     // 게시글 번호 체크
     $no = 0;
     if(isset($_GET['no']) && $_GET['no'] > 0) {
         $no = $utility->filter_SQL($_GET['no']);
     }

    // 게시글 id 체크
    $boardId = $utility->filter_SQL($_GET['boardId']);

    $result = $dao->getBoardById($boardId);
    $writer = $result['board']['id'];

    // 게시글의 작성자와 로그인 한 회원의 아이디가 동일한지 체크
    $isWriter = false;
    if($writer == $user['userId']) {
        $isWriter = true;
    }

    // 삭제할 게시글의 파일 삭제
    if(!empty($result['image'])) {

        for($i = 0; $i < count($result['image']); $i++) {

            $imgPath = $_SERVER['DOCUMENT_ROOT'] . $result['image'][$i]['path'];
            unlink($imgPath);
        }
    }

    // 삭제
    $deleteResult = $dao->deleteBoardById($boardId);
    echo json_encode($deleteResult);