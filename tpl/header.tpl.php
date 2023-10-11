<header class="body-header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/loginboard2/controller/board/BoardListController.php" style="padding: 15px 10px;">
                    다나가게시판
                </a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <?php if(!isset($_SESSION['userId'])) {?>
                    <li>
                        <a href="/loginboard2/controller/user/UserJoinController.php"><span class="glyphicon glyphicon-user"></span> 회원가입</a>
                    </li>
                    <li>
                        <a href="/loginboard2/controller/user/UserLoginController.php"><span class="glyphicon glyphicon-log-in"></span> 로그인</a>
                    </li>
                <?php }else{ ?>
                    <li>
                        <p style="margin-top:13px;"><?=$_SESSION['userId']?>님 안녕하세요</p>
                    </li>
                    <li>
                        <a href="javascript:location.href='/loginboard2/controller/user/UserInfoController.php'">회원정보</a>
                    </li>
                    <li>
                        <a href="javascript:location.href='/loginboard2/process/user/logout.php'"><span class="glyphicon glyphicon-log-out"></span> 로그아웃</a>
                    </li>
                    <?php if($_SESSION['user'] == 'admin') { ?>
                        <li>
                            <a href="/loginboard2/controller/admin/MenuListController.php"><span class="glyphicon glyphicon-cog"></span> 관리자 페이지</a>
                        </li> 
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>  
    </nav>

    <div class='container body-container'>
        <ul class='nav nav-tabs'>
            <?php for($i = 0; $i < count($categoryList); $i++) {?>
                <li class='dropdown'>
                    <a class='dropdow-toggle' data-toggle='dropdown'><?=$categoryList[$i]['name']?></a>
                    <ul class='dropdown-menu'>
                        <?php 
                            for($j = 0; $j < count($menuList); $j++) { 
                                if(($categoryList[$i]['id'] == $menuList[$j]['category_id']) && ($menuList[$j]['only_menu'] == 0) && empty($menuList[$j]['parent_id'])) {
                        ?>
                                <li><a href="/loginboard2/controller/board/BoardListController.php?category=<?=$categoryList[$i]['id']?>&menu=<?=$menuList[$j]['id']?>">
                                    <?=$menuList[$j]['name']?>
                                </a></li>
                        <?php
                                }
                                else if(($categoryList[$i]['id'] == $menuList[$j]['category_id']) && ($menuList[$j]['only_menu'] == 1)) {
                        ?>
                                <li style='font-size: small;'><?=$menuList[$j]['name']?></li>
                        <?php
                                }
                                else if(($categoryList[$i]['id'] == $menuList[$j]['category_id']) && ($menuList[$j]['only_menu'] == 0) && !empty($menuList[$j]['parent_id'])) {
                        ?>
                            <li><a href="/loginboard2/controller/board/BoardListController.php?category=<?=$categoryList[$i]['id']?>&menu=<?=$menuList[$j]['id']?>"><?=$menuList[$j]['name']?></a></li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
</header>