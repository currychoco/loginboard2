<?php
    session_start();
    ini_set('display_errors', 1);

    require_once $_SERVER['DOCUMENT_ROOT'] . "/loginboard2/conf.php";
    require_once ROOT_PATH . "/common/Template.php";
    require_once ROOT_PATH . "/common/Utility.php";
    require_once DAO_PATH . "/board/DanawaBoardList.DAO.php";

    $utility = new Utility();

    $no = 0;
    if(isset($_GET['no']) && $_GET['no'] > 0) {
        $no = $_GET['no'];
        $no = $utility->filter_SQL($no);
    }

    // 검색 키워드 체크
    $search = '';
    if(isset($_GET['search'])) {
        $search = $utility->filter_SQL($_GET['search']);
    }
    

    $boardDao  = new DanawaBoardList();

    // 리스트
    $listResult = $boardDao->getBoardList($no, PAGE_SIZE, $search);

    // 리스트 총 개수
    $listResultCnt = $boardDao->getBoardListCount($search);

    //생성자
    $oTemplate = new Template();

    //변수 셋팅
	$oTemplate->set("listResult", $listResult);
    $oTemplate->set("no", $no);
    $oTemplate->set("totalRow", $listResultCnt);
    $oTemplate->set("pageSize", PAGE_SIZE);
    $oTemplate->set("pageListSize", PAGE_LIST_SIZE);
    $oTemplate->set('search', $search);

    //템플릿 위치 지정
    //$templateType = ROOT_PATH . "/tpl/board/boardListView.tpl.php"; // 기존에 페이징 부분을 'include'로 처리했었던 템플릿
	$templateType = ROOT_PATH . "/tpl/board/paginationTest.tpl.php"; // 페이징 부분을 ajax를 통해 html 문서를 받아오는 템플릿

    //패치
    echo $oTemplate->fetch($templateType);