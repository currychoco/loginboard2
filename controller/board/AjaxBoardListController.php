<?php
    session_start();
    ini_set('display_errors', 1);

    require_once $_SERVER['DOCUMENT_ROOT']."/loginboard2/conf.php";
    require_once ROOT_PATH . "/common/Template.php";
    require_once ROOT_PATH . "/common/Utility.php";
    require_once DAO_PATH . "/board/DanawaBoardList.DAO.php";

    $utility = new Utility();

    $no = 0;
    if(isset($_GET['no']) && $_GET['no'] > 0) {
        $no = $_GET['no'];
    }

    $no = $utility->filter_SQL($no);

    $boardDao  = new DanawaBoardList();

    // 리스트 총 개수
    $listResultCnt = $boardDao->getBoardListCount();

    //생성자
    $oTemplate = new Template();

    //변수 셋팅
    $oTemplate->set("no", $no);
    $oTemplate->set("totalRow", $listResultCnt);
    $oTemplate->set("pageSize", PAGE_SIZE);
    $oTemplate->set("pageListSize", PAGE_LIST_SIZE);

    //템플릿 위치 지정
	$templateType = ROOT_PATH . '/tpl/board/ajaxBoardList.tpl.php'; // 페이징 부분을 ajax를 통해 html 문서를 받아오는 템플릿

    //패치
    echo $oTemplate->fetch($templateType);