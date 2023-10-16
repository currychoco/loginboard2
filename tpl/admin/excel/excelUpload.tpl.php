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
                <h3>엑셀 정보 저장</h3>
            </div>
            <br>
            <form enctype='multipart/form-data' action='/loginboard2/process/admin/excel/uploadExcel.php' method='post'>
                <table class='table'>
                    <colgroup>
                        <col width="20%" />
                        <col width="80%" />
                    </colgroup>
                    <tr>
                        <th>주의 사항</th>
                        <td>※양식을 따른 엑셀 파일만을 업로드 해주세요※</td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <input type='file' name='excelFile'>
                            <br>
                            <input class='btn btn-success' type='submit' value='업로드'>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <form>
            <input type='hidden' id='auth' value="<?=$auth?>">
        </form>
	</body>
</html>