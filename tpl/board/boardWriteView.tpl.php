<!DOCTYPE html>
<html>
	<head>
        <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/head.php"; ?>
        <script src='/loginboard2/js/board/board.js'></script>
        <script src='/loginboard2/js/admin/admin.js'></script>
        <script>

            $(function() {

                checkLogin();
                getWriteMenuList();

                $('#write').click(function() {
                    createBoard();
                });

                $('#toList').click(function() {
                    toListButton();
                });

                $('#selectCategory').on('change', function() {
                    getWriteMenuList();
                });
            })

        </script>
    </head>
	<body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/header.php"; ?>

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
                        <th>제목</th>
                        <td>
                            <input type="text" class="form-control" name="title" id="title" size=60 maxlength=35>
                        </td>
                    </tr>
                    <tr>
                        <th>카테고리</th>
                        <td>
                            <select class='form-control' id='selectCategory' name='selectCategory'>
                                <?php for($i = 0; $i < count($categoryList); $i++) { ?>
                                    <option value="<?=$categoryList[$i]['id']?>"><?=$categoryList[$i]['name']?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>게시판</th>
                        <td id='menuList'></td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td>
                            <textarea class="form-control" name="content" id="content" cols=65 rows=15></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type='file' name='imageFile[]' multiple>
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