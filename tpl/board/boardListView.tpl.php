<!DOCTYPE html>
<html>
	<head>
	    <?php include ROOT_PATH . '/common/head.php'?>
	</head>
	<body>
        <!-- header -->
        <?php include ROOT_PATH . '/common/header.php'?>
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
                            <a href="/loginboard/board/read.php?id=<?=$listResult[$i]['id']?>&no=<?=$no?>"><?=$listResult[$i]['id']?></a>
                        </td>
                        <td>
                            <a href="/loginboard/board/read.php?id=<?=$listResult[$i]['id']?>&no=<?=$no?>"><?=$listResult[$i]['title']?></a>
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
                <input type="hidden" value="<?=$no?>">
            </form>
            <div class="text-center">
                <?php include ROOT_PATH . "/common/pagination.php"?>
            </div>
            <a href="write.php" style="float:right;">
                <button class="btn btn-primary">글쓰기</button>
            </a>
        </div>
	</body>
</html>