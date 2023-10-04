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
                <div class="form-inline" style="margin-bottom: 15px">
                    <input type="text" class="form-control" name="name" id="name" placeholder="카테고리명" />
                </div>
                <div class="form-inline" style="margin-bottom: 15px">
                    <input type="tel" class="form-control" name="content" id="content" placeholder="카테고리 설명" />
                    <span id="checkNumResult"></span>
                </div>
                <div class="form-inline" style="margin-bottom: 15px">
                    <button type="button" class="btn btn-primary" id="categoryFormButton">생성</button>
                </div>
            </form>
        </div>
	</body>
</html>