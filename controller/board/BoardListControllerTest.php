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
    $pageSize = $_GET['pageSize'];

    $boardDao  = new DanawaBoardList();

    // 리스트
    $listResult = $boardDao->getBoardList($no, $pageSize);

    //생성자
    $oTemplate = new Template();

    //변수 셋팅
	$oTemplate->set("listResult", $listResult);

    //템플릿 위치 지정
	$templateType = ROOT_PATH . "/tpl/board/boardList.tpl.php";

    //패치
    echo $oTemplate->fetch($templateType);