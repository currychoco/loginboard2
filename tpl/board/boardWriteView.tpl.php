<!DOCTYPE html>
<html>
	<head>
        <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard/comm/head.php"; ?>
        <script src='/loginboard2/js/board/board.js'></script>
        <script>

            $(function() {

                checkLogin();

                $('#write').click(function() {
                    writeButton();
                });

                $('#toList').click(function() {

                });

            })

        </script>
    </head>
	<body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard/comm/header.php"; ?>

        <div class="container body-container">
            <br>

            <form >
                <input type='hidden' id='checkLogin' value="<?=$checkLogin?>">
            </form>

            <form id="writeForm" enctype='multipart/form-data' action='/loginboard2/process/board/write.php' method='POST'> 
                <input type='hidden' id='no' value="<?=$no?>">
                <table class="table">
                    <colgroup>
                        <col width="10%" />
                        <col width="90%" />
                    </colgroup>
                    <tr>
                        <td>제목</td>
                        <td>
                            <input type="text" class="form-control" name="title" id="title" size=60 maxlength=35>
                        </td>
                    </tr>
                    <tr>
                        <td>내용</td>
                        <td>
                            <textarea class="form-control" name="content" id="content" cols=65 rows=15></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type='file' name='imageFile' >
                            <br>
                            <input type="button" class="btn" id='write' value="글 저장하기">
                            &nbsp;&nbsp;
                            <input type="reset" class="btn" value="다시 쓰기">
                            &nbsp;&nbsp;
                            <input type="button" class="btn" id='toList' value="목록">
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                </table>
            </form>
        </div>
	</body>
</html>