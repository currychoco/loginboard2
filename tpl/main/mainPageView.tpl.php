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
            <?php 
                for($i = 0; $i < count($categoryList); $i++) {              
            ?>

            <div>
                <h4><?=$categoryList[$i]['name']?></h4>    
                <div class='menuBoard'>
                    <?php 
                    for($j = 0; $j < count($menuList); $j++) { 

                        if(($categoryList[$i]['id'] == $menuList[$j]['category_id']) && $menuList[$j]['only_menu'] == 0) {    
                    ?>

                        <div class='contentBox'>
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th colspan='3'><?=$menuList[$j]['name']?></th>
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
                                            <td><?=$tmp['id']?></td>
                                            <td><?=$tmp['title']?></td>
                                            <td><?=$tmp['commentCnt']?></td>
                                        </tr>
                                    <?php
                                            }
                                        }
                                        else {
                                    ?>
                                        <td colspan='3'>게시글이 존재하지 않습니다.</td>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    <?php
                        } 
                    }
                    ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </body>