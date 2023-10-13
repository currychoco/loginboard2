<!DOCTYPE html>
<html>
	<head>
	    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/common/head.php'?>
        <script src='/loginboard2/js/admin/admin.js'></script>
        <script>
            $(function() {
                authCheck();
            })
        </script>
	</head>
	<body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/admin/adminHeader.php'?>

        <div class="container body-container">
            <div>
                <h3>엑셀 파일 업로드</h3>
            </div>
            <form enctype='multipart/form-data' action='' method='post'>
                <input type='file' name='excelFile'>
                <input type='submit' value='업로드'>
            </form>
        </div>

        <form>
            <input type='hidden' id='auth' value="<?=$auth?>">
        </form>
	</body>
</html>