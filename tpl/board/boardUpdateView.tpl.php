<!DOCTYPE html>
<html>
	<head>
        <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/head.php"; ?>
        <script src='/loginboard2/js/board/board.js'></script>
        <script>

            $(function() {

                checkWriter();

                $('#toList').click(function() {
                    toListButton();
                });

                <?php if(empty($image)) { ?>
                    $('#setFile').show(); 
                <?php } else { ?>
                    $('#getFile').show();
                <?php } ?>

                $('#changeImage').click(function() {
                    $('#getFile').hide();
                    $('#setFile').show(); 
                    $('#changeImage').val('1');
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

            <form id="writeForm" enctype='multipart/form-data' action='/loginboard2/process/board/update.php' method='POST'> 

                <input type='hidden' name='no' id='no' value="<?=$no?>">
                <input type='hidden' name='checkWriter' id='checkWriter' value="<?=$checkWriter?>">
                <input type='hidden' name='boardId' id='boardId' value="<?=$board['id']?>">
                <input type='hidden' name='checkFileUpdate' id='checkFileUpdate' value=''>

                <table class="table">
                    <colgroup>
                        <col width="10%" />
                        <col width="90%" />
                    </colgroup>
                    <tr>
                        <td>제목</td>
                        <td>
                            <input type="text" class="form-control" name="title" id="title" size=60 maxlength=35 value="<?=$board['title']?>">
                        </td>
                    </tr>
                    <tr>
                        <td>내용</td>
                        <td>
                            <textarea class="form-control" name="content" id="content" cols=65 rows=15><?=$board['content']?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id='setFile' style='display:none'>
                                <input type='file' name='imageFile'>
                                <br>
                            </div>
                            <div id='getFile' style='display:none'>
                                <p>
                                    <input type='button' id='changeImage' value='이미지 파일 변경하기'>
                                    저장된 파일 : <?=$image['original_name']?>
                                </p>
                            </div>
                            <input type="submit" class="btn btn-success" id='update' value="글 수정하기">
                            &nbsp;&nbsp;
                            <input type="reset" class="btn btn-warning" value="다시 쓰기">
                            &nbsp;&nbsp;
                            <input type="button" class="btn btn-primary" id='toList' value="목록">
                            &nbsp;&nbsp;
                        </td>
                    </tr>
                </table>
            </form>
        </div>
	</body>
</html>