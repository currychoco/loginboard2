<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once DAO_PATH . '/board/DanawaBoardList.DAO.php';

    $dao = new DanawaBoardList();
    
    for($i = 0; $i < 17; $i++) {
        $dao->insertBoard('키위 제목 ' . $i, '키위 내용 ' . $i, 12);
    }