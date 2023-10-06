<?php
    session_start();
    ini_set('display_errors', 1);

    require_once $_SERVER['DOCUMENT_ROOT'] . "/loginboard2/conf.php";
    require_once ROOT_PATH . "/common/Template.php";
    require_once ROOT_PATH . "/common/Utility.php";
    require_once DAO_PATH . "/board/DanawaBoardList.DAO.php";

    $utility = new Utility();

    $no = 1;
    if(isset($_GET['no']) && $_GET['no'] > 0) {
        $no = $_GET['no'];
        $no = $utility->filter_SQL($no);
    }

    $firstNo = ($no - 1) * PAGE_SIZE;

    // 검색 키워드 체크
    $search = '';
    if(isset($_GET['search'])) {
        $search = $utility->filter_SQL($_GET['search']);
    }

    $keyword = '';
    if(isset($_GET['keyword'])) {
        $keyword = $utility->filter_SQL($_GET['keyword']);
    }
    
    // list 파라미터 체크
    $list = '';
    $setList = '';
    if(isset($_GET['list'])) {
        $list = $utility->filter_SQL(($_GET['list']));

        // 쿠키 list 설정
        if($list == 'text') {
            setcookie('list', 'text', time() + 86400);
        }
        else if($list == 'image') {
            setcookie('list', 'image', time() + 86400);
        }

        $setList = $list;
    }
    else {
        
        if(isset($_COOKIE['list'])) {
            $setList = $utility->filter_SQL($_COOKIE['list']);
        }
        else {
            $setList = 'text';
        }
    }
    

    $boardDao  = new DanawaBoardList();

    $menuId = 2;
    if(isset($_GET['menu'])) {
        $menuId = $utility->filter_SQL($_GET['menu']);
    }  

    // 리스트
    $listResult = $boardDao->getBoardList($firstNo, PAGE_SIZE, $search, $keyword, $menuId);

    // 리스트 총 개수
    $listResultCnt = $boardDao->getBoardListCount($search, $keyword, $menuId);

    //생성자
    $oTemplate = new Template();

    //변수 셋팅
	$oTemplate->set("listResult", $listResult);
    $oTemplate->set("no", $no);
    $oTemplate->set("totalRow", $listResultCnt);
    $oTemplate->set("pageSize", PAGE_SIZE);
    $oTemplate->set("pageListSize", PAGE_LIST_SIZE);
    $oTemplate->set('keyword', $keyword);
    $oTemplate->set('search', $search);
    $oTemplate->set('list', $setList);

    //템플릿 위치 지정
    //$templateType = ROOT_PATH . "/tpl/board/boardListView.tpl.php"; // 기존에 페이징 부분을 'include'로 처리했었던 템플릿
	$templateType = ROOT_PATH . "/tpl/board/paginationTest.tpl.php"; // 페이징 부분을 ajax를 통해 html 문서를 받아오는 템플릿

    //패치
    echo $oTemplate->fetch($templateType);