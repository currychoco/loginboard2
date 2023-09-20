<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/head.php"; ?>
    </head>
    <body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/header.php"; ?>

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
                        <pre><img src="<?=$image['path']?>" alt='왜안뜨죠'/><br><?=$board['content']?>
                        </pre>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>