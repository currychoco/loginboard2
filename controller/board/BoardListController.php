<?php
    use dao\DanawaBoardList;
    use dao\Menu;

    session_start();
    ini_set('display_errors', 1);

    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';
    
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

    $boardDao = new DanawaBoardList();

    $urlMenuId = 2;
    if(isset($_GET['menu'])) {
        $urlMenuId = $utility->filter_SQL($_GET['menu']);
    }  

    $urlCategoryId = 5;
    if(isset($_GET['category'])) {
        $categoryId = $utility->filter_SQL($_GET['category']);
    }

    // 메뉴 정보
    $menuDao = new Menu();
    $menu = $menuDao->getMenuById($urlMenuId);

    // 리스트
    $listResult = $boardDao->getBoardList($firstNo, PAGE_SIZE, $search, $keyword, $urlMenuId);

    // 리스트 총 개수
    $listResultCnt = $boardDao->getBoardListCount($search, $keyword, $urlMenuId);

    //생성자
    $oTemplate = new Template();

    //변수 셋팅
	$oTemplate->set('listResult', $listResult);
    $oTemplate->set('no', $no);
    $oTemplate->set('totalRow', $listResultCnt);
    $oTemplate->set('pageSize', PAGE_SIZE);
    $oTemplate->set('pageListSize', PAGE_LIST_SIZE);
    $oTemplate->set('keyword', $keyword);
    $oTemplate->set('search', $search);
    $oTemplate->set('list', $setList);
    $oTemplate->set('menu', $menu);
    $oTemplate->set('urlCategoryId', $urlCategoryId);
    $oTemplate->set('urlMenuId', $urlMenuId);

    //템플릿 위치 지정
	$templateType = ROOT_PATH . '/tpl/board/paginationTest.tpl.php';

    //패치
    echo $oTemplate->fetch($templateType);