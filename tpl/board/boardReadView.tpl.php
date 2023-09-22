<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/head.php"; ?>
        <script src='/loginboard2/js/board/board.js'></script>
        <script>
            $(function() {
                $('#update').click(function() {
                    toUpdateButton();
                });

                $('#toList').click(function() {
                    toListButton();
                });

                $('#delete').click(function() {
                    deleteBoard();
                });
            })
        </script>
    </head>
    <body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/header.php"; ?>

        <form>
            <input type='hidden' id='no' value="<?=$no?>">
            <input type='hidden' id='boardId' value="<?=$board['id']?>">
            <input type='hidden' id='search' value="<?=$search?>">
        </form>

        <div class="container body-container">
            <table class="table">
                <tr>
                    <th colspan=4>
                        <p><b><?=$board['title']?></b></p>
                    </th>
                </tr>
                <tr>
                    <th colspan=1>글쓴이</th>
                    <td colspan=3><?=$board['user_id']?></td>
                </tr>
                <tr>
                    <th>날짜</th>
                    <td><?=$board['reg_date']?></td>
                    <th>조회수</th>
                    <td><?=$board['view_count']?></td>
                </tr>
                <tr>
                    <td colspan = 4>
                        <div style='text-align:center; margin:10px'>
                            <?php if(!empty($image)) { ?>
                                <img src="http://myimage.com<?=$image['path']?>"/>
                            <?php } ?>
                        </div>
                        <div>
                            <pre><?=$board['content']?></pre>
                        </div>
                    </td>
                </tr>
                <tr>
                    <!-- 기타 버튼 -->
                    <td colspan = 4>
                        <button class="btn btn-primary" id='toList'>목록보기</button>
                        <?php
                            if(!empty($user) && ($user['userId'] == $board['user_id'])){
                        ?>
                            <button class="btn btn-warning" id='update'>수정</button>
                            <button class="btn btn-danger" id='delete'>삭제</button>
                        <?php
                            }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>