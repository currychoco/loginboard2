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

                <?php 
                
                for($j = 0; $j < count($menuList); $j++) { 

                    if(($categoryList[$i]['id'] == $menuList[$j]['category_id']) && $menuList[$j]['only_menu'] == 0) {    
                ?>

                    <div>
                        <h5><?=$menuList[$j]['name']?></h5>
                        <ul>
                            <li>
                                
                            </li>
                        </ul>
                    </div>

                <?php
                    } 
                }
                ?>
            </div>

            <?php } ?>
        </div>
    </body>