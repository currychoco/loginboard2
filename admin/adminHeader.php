<header class="body-header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/loginboard2/controller/admin/MenuListController.php" style="padding: 15px 10px;">
                    다나가 관리자
                </a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <p style="margin-top:13px;"><?=$_SESSION['userId']?>님 안녕하세요</p>
                </li>
                <li>
                    <a href="javascript:location.href='/loginboard2/process/user/logout.php'"><span class="glyphicon glyphicon-log-out"></span> 로그아웃</a>
                </li>

                <li>
                    <a href="/loginboard2/controller/board/BoardListController.php"><span class="glyphicon glyphicon-list"></span> 다나가게시판</a>
                </li> 
            </ul>
        </div>
    </nav>

    <div class="col-sm-1 sidenav">
        <table class='table'>
            <thead>
                <tr>
                    <th>관리자 메뉴</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href='/loginboard2/controller/admin/CategoryListController.php'>카테고리</a></td>
                </tr>
                <tr>
                    <td><a href='/loginboard2/controller/admin/MenuListController.php'>메뉴</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</header>