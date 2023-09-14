<!DOCTYPE html>
<html>
	<head>
	    <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/head.php"; ?>
        <script src='/loginboard2/js/user/join.js'></script>
        <script>
            // 로그인 체크
            const userId = "<?= $userId ?>";
            if(userId){
                location.href = '/loginboard2/controller/board/BoardListController.php';
            }
        </script>

	</head>
	<body>
        <!-- header -->
        <?php include ROOT_PATH . "/common/header.php"; ?>

        <div class="container body-container">
            <h3 class="title">회원가입</h3>
            <form action = "/loginboard2/process/user/join.php" method = "POST" id = "joinForm">
                <div class="form-inline" style="margin-bottom: 15px">
                    <input type="text" class="form-control" name="name" id="name" placeholder="이름" required />
                    <span id="checkNameResult"></span>
                </div>
                <div class="form-inline" style="margin-bottom: 15px">
                    <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="휴대전화" required />
                    <span id="checkNumResult"></span>
                </div>
                <div class="form-inline" style="margin-bottom: 15px">
                    <input type="text" class="form-control" id="userId" name="userId" placeholder="아이디" required />
                    <button type="button" class="btn" id="idCheckButton">중복확인</button>
                    <span id="checkResult"></span>
                </div>
                <div class="form-inline" style="margin-bottom: 15px">
                    <input type="password" class="form-control" name="password" id="password" placeholder="비밀번호" required />
                    <span id="checkPwValResult"></span>
                </div>
                <div class="form-inline" style="margin-bottom: 15px">
                    <input type="password" class="form-control" id="checkPassword" placeholder="비밀번호 확인" required />
                    <span id="checkPwResult"></span>
                </div>
                <div class="form-inline" style="margin-bottom: 15px">
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="0">남성</option>
                        <option value="1">여성</option>
                    </select>
                </div>
                <div class="form-inline" style="margin-bottom: 15px">
                    <button type="button" class="btn btn-primary" id="joinButton">생성</button>
                </div>
                <div>
                    <input type="hidden" id="checkedId">
                </div> 
            </form>
        </div>
	</body>
</html>