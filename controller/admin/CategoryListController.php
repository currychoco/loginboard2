<?php
    session_start();
    ini_set('display_errors', 1);

    require_once $_SERVER['DOCUMENT_ROOT']."/loginboard2/conf.php";
    require_once ROOT_PATH . "/common/Template.php";
    require_once ROOT_PATH . "/common/Utility.php";
    require_once DAO_PATH . '/admin/Category.DAO.php';

    // 관리자 아닐 경우 게시판 리스트로
    if($_SESSION['user'] != 'admin') {
        echo ("
            <script>
                location.href = '/loginboard2/controller/board/BoardListController.php';
            </script>
        ");
    }

    $dao = new CategoryDAO();
    $listResult = $dao->getCategoryList();

    //생성자
    $oTemplate = new Template();

    //변수 셋팅
	$oTemplate->set("listResult", $listResult);

    //템플릿 위치 지정
	$templateType = ROOT_PATH . "/tpl/admin/categoryList.tpl.php";

    //패치
    echo $oTemplate->fetch($templateType);