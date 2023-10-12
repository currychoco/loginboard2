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
        <div class="container body-container">

            <!-- 카테고리별 메뉴 리스트 -->
            <div>
                <?php 
                    for($i = 0; $i < count($categoryList); $i++) {              
                ?>

                <div>
                    <h4><?=$categoryList[$i]['name']?></h4>    
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
                                        <col style='width:90%'>
                                        <col style='width:10%'>
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th colspan='2'><a href="/loginboard2/controller/board/BoardListController.php?category=<?=$categoryList[$i]['id']?>&menu=<?=$menuList[$j]['id']?>"><?=$menuList[$j]['name']?></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $board = $boardList[$menuList[$j]['id']];
                                            
                                            if(count($board) != 0) {
                                                foreach($board as $b) {
                                                    $tmp = (array)$b;
                                                
                                        ?>
                                            <tr>
                                                <td style='padding-left:16px'><a href="/loginboard2/controller/board/BoardReadController.php?id=<?=$tmp['id']?>"><?=$tmp['title']?></a><span style='color:blue;'>&nbsp;[<?=$tmp['commentCnt']?>]</span></td>
                                                <td><?=$tmp['viewCnt']?></td>
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
    </body>