<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once DAO_PATH . '/board/DanawaBoardList.DAO.php';
    require_once DAO_PATH . '/admin/Menu.DAO.php';

    $menuDao = new MenuDAO();
    $boardDao = new DanawaBoardList();

    