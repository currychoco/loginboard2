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
                <h3>게시글 정보 엑셀로 추출</h3>
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
                                다운로드 받은 엑셀 파일을 함부로 유출하지 마세요!!<br>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <a href='/loginboard2/process/admin/excel/downloadExcel.php'><input class='btn btn-success' type='button' id='download' value='다운로드'></a>
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