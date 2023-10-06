<?php session_start() ?>
<!DOCTYPE html>
<html>
	<head>
	    <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/head.php"; ?>
        <script src='/loginboard2/js/admin/admin.js'></script>
        <script>
            $(function() {
                $('#categoryFormButton').click(function() {
                    createCategory();
                });
            });
        </script>
	</head>
	<body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/admin/adminHeader.php'?>

        <div class="container body-container">
            <h3 class="title">카테고리 생성</h3>
            
            <form id = "categoryForm">

                <table class='table'>
                    <tr>
                        <th>카테고리명</th>
                        <td><input class='form-control' type='text' id='name' name='name'></td>
                    </tr>
                    <tr>
                        <th>카테고리 설명</th>
                        <td><textarea class='form-control' name='content' name='content' cols=65 rows=4></textarea></td>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align:right;'>
                            <button type="button" class="btn btn-primary" id="categoryFormButton">생성</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
	</body>
</html>