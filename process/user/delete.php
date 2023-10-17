<script src='/loginboard2/js/user/user.js'></script>
<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/autoload.php';

    // 로그인 체크
    $userId = null;
    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    }
    echo "<script>loginCheckToDelete('$userId')</script>";

    $dao = new User();
    $utility = new Utility();

    $no = $utility->filter_SQL($_SESSION['no']);
    $userId = $utility->filter_SQL($_SESSION['userId']);

    $result = $dao->deleteUser($no, $userId);

    session_unset();
    session_destroy();
    echo "<script>deleteSuccess('$result')</script>";