<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once EXCEL_PATH;

    if($_SESSION['user'] != 'admin') {
        echo ("
            <script>
                alert('관리자 권한이 필요합니다.');
                location.href = '/loginboard2/controller/main/MainPageController.php;
            </script>
        ");
        exit;
    }

    