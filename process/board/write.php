<?php
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once DAO_PATH . '/board/DanawaBoardList.DAO.php';
    require_once ROOT_PATH . '/common/Utility.php';

    $utility = new Utility();

    // 로그인 체크
    $login = false;
    $user;
    if(isset($_SESSION['userId']) && isset($_SESSION['no'])) {
        $user = $utility->checkLogin($_SESSION['userId'], $_SESSION['no']);
        
        if(!empty($user)) {
            $login = true;
        }
        
    }

    // 제목, 내용 유효성 검사
    if(isset($_POST['title']) && isset($_POST['content'])) {

        $title = $utility->filter_SQL($_POST['title']);
        $content = $utility->filter_SQL($_POST['content']);

        if(strlen($title) < 2 || empty($content)) {
            echo ("
                <script>
                    alert('제목은 2자 이상, 내용은 1자 이상이 필요합니다.');
                    go.history(-1);
                </script>
            ");

            exit;
        }
    }
    
    $dao = new DanawaBoardList();

    // 게시글 생성 후 생성된 게시글의 id 반환
    $boardId = $dao->insertBoard($title, $content, $user['no']);
    
    // 업로드 된 이미지 지정된 파일로 이동
    if($_FILES['imageFile'] != null) {

        $tmp_name = $_FILES['imageFile']['tmp_name'];
        $name = $_FILES['imageFile']['name'];
        $path = ROOT_PATH . "/img/$name";
        $up = move_uploaded_file($tmp_name, $path); // 지정 경로로 파일 업로드

        $serverName = $user['no'] . date('Ymd') . $boardId;
        $size = $_FILES['imageFile']['size'];

        $image = array(
            'boardId' => $boardId,
            'serverName' => $serverName,
            'originalName' => $name,
            'path' => $path,
            'size' => $size
        );
    }