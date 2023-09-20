<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/Template.php';
    require_once ROOT_PATH . '/common/Utility.php';
    require_once DAO_PATH . '/board/DanawaBoardList.DAO.php';

    $utility = new Utility();
    $dao = new DanawaBoardList();

    // 게시글 페이지 번호 체크
    $no = 0;
    if(isset($_GET['no']) && $_GET['no'] > 0) {
        $no = $utility->filter_SQL($_GET['no']);
    }

    //  게시글 번호 체크
    $tmp_id = $_GET['id'];
    $id = $utility->filter_SQL($tmp_id);

    // 번호 기반 글 가져오기
    $result = $dao->getBoardById($id);
    $board = $result['board'];
    $image = $result['image'];

    // 템플릿 클래스 생성
    $oTemplate = new Template();

    $oTemplate->set('no', $no);
    $oTemplate->set('board', $board);
    $oTemplate->set('image', $image);

    $templateType = ROOT_PATH . '/tpl/board/boardReadView.tpl.php';

    echo $oTemplate->fetch($templateType);