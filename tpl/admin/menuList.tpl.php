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

            관리자 페이지입니다~

            <table>
                <thead>
                   <tr>
                        <td>아이디</td>
                        <td>메뉴명</td>
                   </tr> 
                </thead>
                <tbody>
                <?php for($i = 0; $i < count($listResult); $i++) { ?>
                    <tr>
                        <td>
                            <a href=''><?=$listResult[$i]['id']?></a>
                        </td>
                        <td>
                            <a href=''><?=$listResult[$i]['name']?></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <div style="float:right;">
                <button class="btn btn-primary" id='toMakeCategory' style="margin-bottom: 20px">카테고리 생성</button>
                <button class="btn btn-primary" id='toMakeMenu' style="margin-bottom: 20px">메뉴 생성</button>
            </div>

        </div>
	</body>
</html>