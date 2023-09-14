<!DOCTYPE html>
<html>
	<head>
	    <?php include ROOT_PATH . '/common/head.php'; ?>
        <script src="/loginboard2/js/user/user.js"></script>
        <script>
            $(function(){
                $('#deleteButton').click(function(){
                    clickDeleteButton();
                });
                $('#updateButton').click(function(){
                    clickUpdateButton();
                })
            });
        </script>
	</head>
    <body>
        <!-- header -->
        <?php include ROOT_PATH . '/common/header.php'; ?>

        <div class="container body-container">
            <h3 class="title">회원정보</h3>
            <table class="table table-striped">
                <tr>
                    <th>아이디</th>
                    <td><?=$row['user_id']?></td>
                </tr>
                <tr>
                    <th>이름</th>
                    <td><?=$row['name']?></td>
                </tr>
                <tr>
                    <th>휴대폰 번호</th>
                    <td><?=$row['phone_number']?></td>
                </tr>
                <tr>
                    <th>성별</th>
                    <td><?php echo $row['gender']==0?"남자":"여자"; ?></td>
                </tr>
                <tr>
                    <th>가입일자</th>
                    <td><?=$row['reg_date']?></td>
                </tr>
            </table>
            <div style="float:right;">
                <button class="btn btn-primary" id="updateButton">정보수정</button>
                <button class="btn btn-warning" id="deleteButton">회원탈퇴</button>
            </div>
        </div>
    </body>
</html>