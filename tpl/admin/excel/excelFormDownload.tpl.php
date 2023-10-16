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
                <h3>엑셀 양식 다운로드</h3>
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
                        <td>
                            <p>
                                다운 받은 양식에 정보를 잘 기입해 주십시오.<br>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <a href='/loginboard2/process/admin/excel/downloadExcelForm.php'><input class='btn btn-success' type='button' value='다운로드'></a>
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