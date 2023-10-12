<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once DAO_PATH . '/board/DanawaBoardList.DAO.php';
    require_once DAO_PATH . '/admin/Menu.DAO.php';

    $menuDao = new MenuDAO();
    $boardDao = new DanawaBoardList();

    $menuList = $menuDao->getMenuListNotOnlyMenu();

    $boardList = array();
    foreach($menuList as $menu) {
        
        $result = $boardDao->getBoardListForCache($menu['id']);
        
        $boardArr = array();
        foreach($result as $board) {
            
            $arr = array(
                'id' => $board['id'],
                'title' => $board['title'],
                'menuId' => $board['menu_id'],
                'commentCnt' => $board['comment_cnt']
            );

            array_push($boardArr, $arr);
        }

        $boardList[$menu['id']] = $boardArr;

    }

    $filename = ROOT_PATH . '/cache.php';
    $fp = fopen($filename, 'w');
    fwrite($fp, json_encode($boardList));
    fclose($fp);

    echo '저장 됐는지 확인해봐!';