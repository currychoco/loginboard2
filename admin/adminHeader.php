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

    <div class="col-sm-2 sidenav">
        <div>
            <h4>관리자 메뉴</h4>
        </div>
        <div>
            <ul class='nav nav-pills nav-stacked'>
                <li><a href='/loginboard2/controller/admin/CategoryListController.php'>카테고리 작업</a></li>
                <li><a href='/loginboard2/controller/admin/MenuListController.php'>메뉴 작업</a></li>
                <li>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">엑셀 작업<span class="caret"></span></a>
                    <ul class='dropdown-menu'>
                        <li><a href='/loginboard2/controller/admin/excel/ExcelUploadController.php'>엑셀 정보 저장</a></li>
                        <li><a href='#'>정보 엑셀로 추출</a></li>
                        <li><a href='/loginboard2/controller/admin/excel/ExcelFormDownloadController.php'>엑셀 양식 다운로드</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</header>