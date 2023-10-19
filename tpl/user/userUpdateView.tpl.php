<!DOCTYPE html>
<html>
	<head>
	    <?php include ROOT_PATH . '/common/head.php'; ?>
        <script src="/loginboard2/js/user/user.js"></script>
        <script src='/loginboard2/js/common/common.js'></script>
        <script>
            $(function(){

                header();
                
                $('#updateCancel').click(function(){
                    updateCancel();
                });
                $('#userUpdate').click(function(){
                    updateUser();
                })
            });
        </script>
	</head>
    <body>
        <!-- header -->
        <div id='header'>

        </div>

        <div class="container body-container">
            <h3 class="title">회원정보 수정</h3>
        
            <form action="/loginboard2/process/user/update.php" method="POST" id="userUpdateForm">

                <table class="table table-striped">
                    <tr>
                        <th>아이디</th>
                        <td><?=$row['user_id']?></td>
                    </tr>
                    <tr>
                        <th>이름</th>
                        <td><input type="text" name="name" id="name" value="<?=$row['name']?>"></td>
                    </tr>
                    <tr>
                        <th>휴대폰 번호</th>
                        <td><input type="text" name="phoneNumber" id="phoneNumber" value="<?=$row['phone_number']?>"></td>
                    </tr>
                    <tr>
                        <th>성별</th>
                        <td>
                            <select class="form-control" id="gender" name="gender" value="<?=$row['gender']?>">
                                <option value="0">남성</option>
                                <option value="1">여성</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>가입일자</th>
                        <td><?=$row['reg_date']?></td>
                    </tr>
                </table>
            </form>
            <div style="float:right;">
                <button class="btn btn-primary" id="updateCancel">수정취소</button>
                <button class="btn btn-primary" id="userUpdate">수정</button>
            </div>
        </div>
    </body>
</html>