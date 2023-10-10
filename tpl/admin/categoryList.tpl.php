<!DOCTYPE html>
<html>
	<head>
	    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/common/head.php'?>
        <script src='/loginboard2/js/admin/admin.js'></script>
        <script>
            $(function() {
                $('#toMakeCategory').click(function() {
                    toMakeCategory();
                });
            });
        </script>
	</head>
	<body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/admin/adminHeader.php'?>

        <div class="container body-container">

            <h3>카테고리 리스트</h3><br>

            <table class="table table-hover">
                <thead>
                   <tr>
                        <th>아이디</th>
                        <th>이름</th>
                        <th>설명</th>
                        <th>순서</th>
                   </tr> 
                </thead>
                <tbody>
                <?php for($i = 0; $i < count($listResult); $i++) { ?>
                    <tr>
                        <td>
                            <a href="/loginboard2/controller/admin/UpdateCategoryController.php?type=read&categoryId=<?=$listResult[$i]['id']?>"><?=$listResult[$i]['id']?></a>
                        </td>
                        <td>
                            <a href="/loginboard2/controller/admin/UpdateCategoryController.php?type=read&categoryId=<?=$listResult[$i]['id']?>"><?=$listResult[$i]['name']?></a>
                        </td>
                        <td>
                            <?=$listResult[$i]['content']?>
                        </td>
                        <td>
                            <?=$listResult[$i]['order']?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <div style="float:right;">
                <button class="btn btn-primary" id='toMakeCategory' style="margin-bottom: 20px">카테고리 생성</button>
            </div>

        </div>
	</body>
</html>