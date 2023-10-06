<!DOCTYPE html>
<html>
	<head>
	    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/common/head.php'?>
        <script src='/loginboard2/js/admin/admin.js'></script>
        <script>
            $(function() {
                $('#toMakeMenu').click(function() {
                    toMakeMenu();
                });
            });
        </script>
	</head>
	<body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/admin/adminHeader.php'?>

        <div class="container body-container">

            <h3>메뉴 리스트</h3><br>

            <table class="table table-hover">
                <thead>
                   <tr>
                        <th>아이디</th>
                        <th>카테고리</th>
                        <th>이름</th>
                        <th>순서</th>
                        <th>상위 메뉴</th>
                   </tr> 
                </thead>
                <tbody>
                <?php for($i = 0; $i < count($listResult); $i++) { ?>
                    <tr>
                        <td>
                            <a href="/loginboard2/controller/admin/UpdateMenuController.php?menuId=<?=$listResult[$i]['id']?>&type=read"><?=$listResult[$i]['id']?></a>
                        </td>
                        <td>
                            <?=$listResult[$i]['category']?>
                        </td>
                        <td>
                            <a href="/loginboard2/controller/admin/UpdateMenuController.php?menuId=<?=$listResult[$i]['id']?>&type=read"><?=$listResult[$i]['name']?></a>
                        </td>
                        <td>
                            <?=$listResult[$i]['order']?>
                        </td>
                        <td>
                            <?=$listResult[$i]['parent_id']?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <div style="float:right;">
                <button class="btn btn-primary" id='toMakeMenu' style="margin-bottom: 20px">메뉴 생성</button>
            </div>

        </div>
	</body>
</html>