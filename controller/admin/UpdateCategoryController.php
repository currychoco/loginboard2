<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/loginboard2/conf.php";
    require_once ROOT_PATH . "/common/Template.php";
    require_once ROOT_PATH . "/common/Utility.php";
    require_once DAO_PATH . "/board/DanawaBoardList.DAO.php";

    // 관리자 아닐 경우 게시판 리스트로
    if($_SESSION['user'] != 'admin') {
        echo ("
            <script>
                location.href = '/loginboard2/controller/board/BoardListController.php';
            </script>
        ");
    }