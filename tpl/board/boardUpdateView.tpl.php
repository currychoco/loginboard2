<!DOCTYPE html>
<html>
	<head>
        <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/head.php"; ?>
        <script src='/loginboard2/js/board/board.js'></script>
        <script src='/loginboard2/js/admin/admin.js'></script>
        <script>

            $(function() {

                checkWriter();
                getWriteMenuList();

                $('#toList').click(function() {
                    toListButton();
                });

                $('#update').click(function() {
                    updateButton();
                })

                <?php if(empty($image)) { ?>
                    $('#setFile').show(); 
                <?php } else { ?>
                    $('#getFile').show();
                <?php } ?>

                $('#changeImage').click(function() {
                    $('#getFile').hide();
                    $('#setFile').show(); 
                    $('#checkFileUpdate').val('1');
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
                <input type='hidden' id='urlCategoryId' value="<?=$urlCategoryId?>">
                <input type='hidden' id='urlMenuId' value="<?=$urlMenuId?>">
                <input type='hidden' id='search' value="<?=$search?>">
                <input type='hidden' id='keyword' value="<?=$keyword?>">
            </form>

            <form id="updateForm" enctype='multipart/form-data' action='/loginboard2/process/board/update.php' method='POST'> 

                <input type='hidden' name='no' id='no' value="<?=$no?>">
                <input type='hidden' name='checkWriter' id='checkWriter' value="<?=$checkWriter?>">
                <input type='hidden' name='boardId' id='boardId' value="<?=$board['id']?>">
                <input type='hidden' name='checkFileUpdate' id='checkFileUpdate' value=''>
                <input type='hidden' name='menu' id='menu' value="<?=$board['menu_id']?>">

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
                        <th>카테고리</th>
                        <td>
                            <select class='form-control' id='selectCategory' name='selectCategory'>
                                <?php for($i = 0; $i < count($categoryList); $i++) { ?>
                                    <option value="<?=$categoryList[$i]['id']?>" <?php if($board['category_id'] == $categoryList[$i]['id']) {?> selected='selected' <?php }?>><?=$categoryList[$i]['name']?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>게시판</th>
                        <td id='menuList'></td>
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
                                <input type='file' name='imageFile[]' multiple>
                                <br>
                            </div>
                            <div id='getFile' style='display:none'>
                                <p>
                                    <input type='button' id='changeImage' value='이미지 파일 변경하기'>
                                    저장된 파일 : 
                                    <?php
                                    for($i = 0; $i < count($image); $i++) {
                                        echo $image[$i]['original_name'];
                                        if($i != count($image) - 1) {
                                            echo ', ';
                                        }
                                    }
                                     
                                    ?>
                                </p>
                            </div>
                            <input type="button" class="btn btn-success" id='update' value="글 수정하기">
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