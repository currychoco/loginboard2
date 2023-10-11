<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/Template.php';
    require_once ROOT_PATH . '/common/Utility.php';
    require_once DAO_PATH . '/board/DanawaBoardList.DAO.php';

    $utility = new Utility();
    $dao = new DanawaBoardList();

    // 게시글 페이지 번호 체크
    $no = 0;
    if(isset($_GET['no']) && $_GET['no'] >= 0) {
        $no = $utility->filter_SQL($_GET['no']);
    }

    // 검색 키워드 체크
    $search = '';
    if(isset($_GET['search'])) {
        $search = $utility->filter_SQL($_GET['search']);
    }

    $urlMenuId = 2;
    if(isset($_GET['menu'])) {
        $urlMenuId = $utility->filter_SQL($_GET['menu']);
    }  

    $urlCategoryId = 5;
    if(isset($_GET['category'])) {
        $categoryId = $utility->filter_SQL($_GET['category']);
    }

    $keyword = '';
    if(isset($_GET['keyword'])) {
        $keyword = $utility->filter_SQL($_GET['keyword']);
    }

    // 로그인 체크
    $login = false;
    $user = null;
    $userId = null;
    if(isset($_SESSION['userId']) && isset($_SESSION['no'])) {
        $user = $utility->checkLogin($_SESSION['userId'], $_SESSION['no']);
        $userId = $user['userId'];
        if(!empty($user)) {
            $login = true;
        }
       
    }

    //  게시글 번호 체크
    $tmp_id = $_GET['id'];
    $id = $utility->filter_SQL($tmp_id);

    // 조회 여부 체크 및 조회수 증가
    if(!isset($_COOKIE['readList'])) {
        $list = array($id);
        setcookie('readList', json_encode($list), time() +3600 * 24);
        $dao->countView($id);
    }
    else {
        $list = json_decode($_COOKIE['readList']);
        
        if(!in_array($id, $list)) {
            $list[] = $id;
            setcookie('readList', json_encode($list), time() +3600 * 24);
            $dao->countView(($id));
        }

    }

    // 번호 기반 글 가져오기
    $result = $dao->getBoardById($id);
    $board = $result['board'];
    $image = $result['image'];
    
    // 템플릿 클래스 생성
    $oTemplate = new Template();

    $oTemplate->set('no', $no);
    $oTemplate->set('board', $board);
    $oTemplate->set('image', $image);
    $oTemplate->set('user', $user);
    $oTemplate->set('userId', $userId);
    $oTemplate->set('search', $search);
    $oTemplate->set('keyword', $keyword);
    $oTemplate->set('urlCategoryId', $urlCategoryId);
    $oTemplate->set('urlMenuId', $urlMenuId);

    $templateType = ROOT_PATH . '/tpl/board/boardReadView.tpl.php';

    echo $oTemplate->fetch($templateType);