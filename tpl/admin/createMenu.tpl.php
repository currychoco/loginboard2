<!DOCTYPE html>
<html>
	<head>
	    <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/head.php"; ?>
        <script src='/loginboard2/js/admin/admin.js'></script>
        <script>
            $(function() {
                $('#menuCreateButton').click(function() {
                    createMenu();
                });
            });
        </script>
	</head>
	<body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/admin/adminHeader.php'?>

        <div class="container body-container">
            <h3 class="title">메뉴 생성</h3>

            <form id = "menuForm">
                <table class='table'>
                    <tr>
                        <th>메뉴명</th>
                        <td><input class='form-control' type='text' id='name' name='name'></td>
                    </tr>
                    <tr>
                        <th>카테고리</th>
                        <td>
                            <select class='form-control' id='categoryId' name='categoryId'>
                                <?php for($i = 0; $i < count($categoryList); $i++) { ?>
                                    <option value="<?=$categoryList[$i]['id']?>"><?=$categoryList[$i]['name']?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>메뉴 설명</th>
                        <td><textarea class='form-control' name="content" id="content" cols=65 rows=4></textarea></td>
                    </tr>
                    <tr>
                        <th>메뉴 보이기</th>
                        <td>
                            <select class='form-control' id='visible' name='visible'>
                                <option value='1'>보이기</option>
                                <option value='0'>숨김</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align:right;'>
                            <input type='button' class='btn btn-primary' id='menuCreateButton' value='생성'>
                            &nbsp;&nbsp;
                            <input type="reset" class="btn" value="다시 쓰기">
                            &nbsp;&nbsp;
                            <input type="button" class="btn" id='toList' value="목록">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
	</body>
</html>