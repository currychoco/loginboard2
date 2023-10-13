<!DOCTYPE html>
<html>
	<head>
	    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/common/head.php'?>
        <script src='/loginboard2/js/common/common.js'></script>
        <script>
             $(function() {
                header();
             });
        </script>
        <link rel = 'stylesheet' href='/loginboard2/css/main.css' />
    </head>

    <body>
        <div id='header'>

        </div>
            <div class='container body-container'>
            <h3>인기글</h3>
                <div class='menuBoard'>
                    
                    <div class='contentBox'>
                        <table class='table'>
                            <colgroup>
                                <col style='width:20%'>
                                <col style='width:60%'>
                                <col style='width:20%'>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan='3'>많은 사람들이 본 글</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $boardListByView = (array)$mainBoardList['boardListByView'];
                                    foreach($boardListByView as $bv) {
                                        $tmp = (array)$bv;
                                ?>
                                    <tr>
                                        <td><a href="/loginboard2/controller/board/BoardListController.php?category=<?=$tmp['category_id']?>&menu=<?=$tmp['menu_id']?>"><?=$tmp['menu']?></a></td>
                                        <td><a href="/loginboard2/controller/board/BoardReadController.php?id=<?=$tmp['id']?>"><?=$tmp['title']?></a><span class='comment'>&nbsp;[<?=$tmp['comment_cnt']?>]</span></td>
                                        <td><span>조회수&nbsp;:&nbsp;</span><?=$tmp['view_count']?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class='contentBox'>
                        <table class='table'>
                             <colgroup>
                                <col style='width:20%'>
                                <col style='width:60%'>
                                <col style='width:20%'>
                            </colgroup>
                            <thead>
                                <tr>
                                    <th colspan='3'>댓글이 활기찬 글</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $boardListByComment = (array)$mainBoardList['boardListByComment'];
                                    foreach($boardListByComment as $bv) {
                                        $tmp = (array)$bv;
                                ?>
                                    <tr>
                                        <td><a href="/loginboard2/controller/board/BoardListController.php?category=<?=$tmp['category_id']?>&menu=<?=$tmp['menu_id']?>"><?=$tmp['menu']?></a></td>
                                        <td><a href="/loginboard2/controller/board/BoardReadController.php?id=<?=$tmp['id']?>"><?=$tmp['title']?></a><span class='comment'>&nbsp;[<?=$tmp['comment_cnt']?>]</span></td>
                                        <td><span>조회수&nbsp;:&nbsp;</span><?=$tmp['view_count']?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                     </div>
                </div>
            <!-- 카테고리별 메뉴 리스트 -->
                <div>
                    <?php 
                        for($i = 0; $i < count($categoryList); $i++) {              
                    ?>

                    <div>
                        <div>
                            <h3><?=$categoryList[$i]['name']?></h3>    
                            <div class='menuBoard'>
                                <?php 
                                $menuCnt = 0;
                                for($j = 0; $j < count($menuList); $j++) { 
                                    if(($categoryList[$i]['id'] == $menuList[$j]['category_id']) && $menuList[$j]['only_menu'] == 0) {    
                                        $menuCnt++;
                                ?>

                                    <div class='contentBox'>
                                        <table class='table'>
                                            <colgroup>
                                                <col style='width:80%'>
                                                <col style='width:20%'>
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th colspan='2'><a href="/loginboard2/controller/board/BoardListController.php?category=<?=$categoryList[$i]['id']?>&menu=<?=$menuList[$j]['id']?>"><?=$menuList[$j]['name']?></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $boardList = (array)$mainBoardList['boardList'];
                                                    $board = $boardList[$menuList[$j]['id']];
                                                    
                                                    if(count($board) != 0) {
                                                        foreach($board as $b) {
                                                            $tmp = (array)$b;
                                                        
                                                ?>
                                                    <tr>
                                                        <td><a href="/loginboard2/controller/board/BoardReadController.php?id=<?=$tmp['id']?>"><?=$tmp['title']?></a><span class='comment'>&nbsp;[<?=$tmp['commentCnt']?>]</span></td>
                                                        <td><span>조회수&nbsp;:&nbsp;</span><?=$tmp['viewCnt']?></td>
                                                    </tr>
                                                <?php
                                                        }
                                                    }
                                                    else {
                                                ?>
                                                    <td colspan='2'>게시글이 존재하지 않습니다.</td>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                <?php
                                    } 
                                }

                                if($menuCnt == 0) {
                                ?>
                                    <p>해당 카테고리에 게시판이 존재하지 않습니다.</p>
                                <?php
                                }
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </body>