<!DOCTYPE html>
<html>
	<head>
	    <?php include  $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/common/head.php'?>
        <script src='/loginboard2/js/board/board.js'></script>
        <script>
            $(function() {
                pagination();

                $('tbody tr:nth-child(odd)').css('background', '#9F9F9F');

                $('button').click(function() {
                    location.href = '/loginboard2/controller/board/BoardWriteController.php?no=' + $('#no').val();
                });
            })
        </script>
	</head>
	<body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/common/header.php'?>
        <div class="container body-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td>번호</td>
                        <td>제목</td>
                        <td>글쓴이</td>
                        <td>날짜</td>
                        <td>조회수</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for($i = 0; $i < count($listResult); $i++) {
                    ?>
                    <tr>
                        <td>
                            <a href="/loginboard2/controller/board/BoardReadController.php?id=<?=$listResult[$i]['id']?>&no=<?=$no?>"><?=$listResult[$i]['id']?></a>
                        </td>
                        <td>
                            <a href="/loginboard2/controller/board/BoardReadController.php?id=<?=$listResult[$i]['id']?>&no=<?=$no?>"><?=$listResult[$i]['title']?></a>
                        </td>
                        <td>
                            <p><?=$listResult[$i]['user_id']?></p>
                        </td>
                        <td>
                            <p><?=$listResult[$i]['reg_date']?></p>
                        </td>
                        <td>
                            <p><?=$listResult[$i]['view_count']?></p>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>

            <form>
                <input type="hidden" value="<?=$no?>" id='no'>
                <input type="hidden" value="<?=$totalRow?>" id='totalRow'>
                <input type="hidden" value="<?=$pageSize?>" id='pageSize'>
                <input type="hidden" value="<?=$pageListSize?>" id='pageListSize'>
            </form>

            <div class="text-center" id='pagination'></div>

            <div style="float:right;">
                <button class="btn btn-primary">글쓰기</button>
            </div>
        </div>
	</body>
</html>