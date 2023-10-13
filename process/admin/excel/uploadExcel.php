<?php
    session_start();


    if($_SESSION['user'] != 'admin') {
        echo ("
            <script>
                alert('관리자 권한이 필요합니다.');
                location.href = '/loginboard2/controller/main/MainPageController.php;
            </script>
        ");
        exit;
    }

    