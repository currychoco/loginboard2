<!DOCTYPE html>
<html>
	<head>
	    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/common/head.php'?>
        <script src='/loginboard2/js/board/board.js'></script>
        <script>
            $(function() {
                pagination();
                getBoardList();
            })
        </script>
	</head>
	<body>
        <!-- header -->
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/common/header.php'?>

        <form>
            <input type="hidden" value="<?=$no?>" id='no'>
            <input type="hidden" value="<?=$totalRow?>" id='totalRow'>
            <input type="hidden" value="<?=$pageSize?>" id='pageSize'>
            <input type="hidden" value="<?=$pageListSize?>" id='pageListSize'>
        </form>

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
                    
                </tbody>
            </table>

            <div class="text-center" id='pagination'></div>

            <a href="/loginboard2/controller/BoardWriteController.php?no=" style="float:right;">
                <button class="btn btn-primary">글쓰기</button>
            </a>
        </div>
	</body>
</html>