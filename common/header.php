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
                        <p style="margin-top:13px;"><?=$_SESSION['userId'];?>님 안녕하세요</p>
                    </li>
                    <li>
                        <a href="javascript:location.href='/loginboard2/controller/user/UserInfoController.php'">회원정보</a>
                    </li>
                    <li>
                        <a href="javascript:location.href='/loginboard2/process/user/logout.php'"><span class="glyphicon glyphicon-log-out"></span> 로그아웃</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>