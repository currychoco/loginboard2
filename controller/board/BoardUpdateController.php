<?php
    session_start();
    ini_set('display_errors', 1);

    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/Template.php';
    require_once ROOT_PATH . '/common/Utility.php';
    require_once DAO_PATH . '/board/DanawaBoardList.DAO.php';

    $utility = new Utility();
    $dao = new DanawaBoardList();

    // 로그인 체크
    $login = false;
    $user = array();
    if(isset($_SESSION['userId']) && isset($_SESSION['no'])) {
        $user = $utility->checkLogin($_SESSION['userId'], $_SESSION['no']);
        
        if(!empty($user)) {
            $login = true;
        }
       
    }

    // 게시글 페이지 번호 체크
    $no = 0;
    if(isset($_GET['no']) && $_GET['no'] > 0) {
        $no = $utility->filter_SQL($_GET['no']);
    }

    // 게시글 정보
    $boardId = $utility->filter_SQL($_GET['boardId']);
    $result = $dao->getBoardById($boardId);
    $board = $result['board'];
    $image = $result['image'];

    // 게시글의 작성자와 로그인 한 회원의 아이디가 동일한지 체크
    $isWriter = false;
    if($board['user_id'] == $user['userId']) {
        $isWriter = true;
    }

    $oTemplate = new Template();

    $oTemplate->set('checkLogin', $login);
    $oTemplate->set('no', $no);
    $oTemplate->set('isWriter', $isWriter);
    $oTemplate->set('board', $board);
    $oTemplate->set('image', $image);

    $templateType = ROOT_PATH . '/tpl/board/boardUpdateView.tpl.php';

    echo $oTemplate->fetch($templateType);