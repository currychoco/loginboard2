<!DOCTYPE html>
<html>
	<head>
	    <?php include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/common/head.php'; ?>
        <script src='/loginboard2/js/admin/admin.js'></script>
        <script>
            $(function() {
                $('#toUpdateCategory').click(function() {
                    toUpdateCategory();
                });
            });
        </script>
	</head>
	<body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/admin/adminHeader.php'?>

        <div class="container body-container">
            <h3 class="title">카테고리</h3>
            
            <form id = "updateCategoryForm">
                <input type='hidden' id='categoryId' name='categoryId' value="<?=$category['id']?>">
                <table class='table'>
                    <tr>
                        <th>카테고리명</th>
                        <td><input class='form-control' type='text' id='name' name='name' value="<?=$category['name']?>" readonly></td>
                    </tr>
                    <tr>
                        <th>카테고리 설명</th>
                        <td><textarea class='form-control' id='content' name='content' cols=65 rows=4 readonly><?=$category['content']?></textarea></td>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align:right;'>
                            <button type="button" class="btn btn-primary" id="toUpdateCategory">수정하기</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
	</body>
</html>