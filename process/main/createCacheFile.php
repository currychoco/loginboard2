<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once DAO_PATH . '/board/DanawaBoardList.DAO.php';
    require_once DAO_PATH . '/admin/Menu.DAO.php';

    $menuDao = new MenuDAO();
    $boardDao = new DanawaBoardList();

    $menuList = $menuDao->getMenuListNotOnlyMenu();
    
    $boardListByViewCnt = $boardDao->getBoardListbyViewCnt();
    $boardListByComment = $boardDao->getBoardListByComment();

    $boardList = array();
    foreach($menuList as $menu) {
        
        $result = $boardDao->getBoardListForCache($menu['id']);
        
        $boardArr = array();
        foreach($result as $board) {
            
            $arr = array(
                'id' => $board['id'],
                'title' => $board['title'],
                'menuId' => $board['menu_id'],
                'commentCnt' => $board['comment_cnt'],
                'viewCnt' => $board['view_count']
            );

            array_push($boardArr, $arr);
        }

        $boardList[$menu['id']] = $boardArr;

    }

    $mainPageBoardList = array(
        'boardList' => $boardList,
        'boardListByView' => $boardListByViewCnt,
        'boardListByComment' => $boardListByComment
    );

    $filename = ROOT_PATH . '/cache.php';
    $fp = fopen($filename, 'w');
    fwrite($fp, json_encode($mainPageBoardList));
    fclose($fp);