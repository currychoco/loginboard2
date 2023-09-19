<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once DAO_PATH . '/board/DanawaBoardList.DAO.php';
    require_once ROOT_PATH . '/common/Utility.php';

    $utility = new Utility();

    $title = $utility->filter_SQL($_POST['title']);
    $content = $utility->filter_SQL($_POST['content']);
    
    // 업로드 된 이미지 지정된 파일로 이동
    if($_FILES['imageFile'] != null) {
        $tmp_name = $_FILES['imageFile']['tmp_name'];
        $name = $_FILES['imageFile']['name'];
        $up = move_uploaded_file($tmp_name, ROOT_PATH . "/img/$name");
    }
