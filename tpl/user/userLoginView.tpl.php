<!DOCTYPE html>
<html>
    <head>
	    <?php require_once ROOT_PATH . "/common/head.php"; ?>
        <script src="/loginboard2/js/user/user.js"></script>
		<script>
            const userId = "<?= $userId ?>";
            loginCheckToLogin(userId);

            $(function() {
                $('#loginButton').click(function(){
                    clickLoginButton($('#userId').val(), $('#password').val());
                });
            });

		</script>
	</head>
	<body>
		<!-- header -->
        <?php include ROOT_PATH . "/common/header.php"; ?>

		<div class="container body-container">
			<form id="loginForm" action="/loginboard2/process/user/login.php" method="post">
				<div class="form-group">
					<input type="text" class="form-control" name="userId" id="userId" placeholder="아이디" />
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password" id="password" placeholder="비밀번호" />
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-primary btn-block" id="loginButton">로그인</button>
				</div>
			</form>
		</div>
	</body>
</html>