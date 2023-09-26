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

     // 게시글 번호 체크
     $no = 0;
     if(isset($_POST['no']) && $_POST['no'] > 0) {
         $no = $utility->filter_SQL($_POST['no']);
     }


    // 제목, 내용 유효성 검사
    if(isset($_POST['title']) && isset($_POST['content'])) {

        // $title = $utility->filter_SQL($_POST['title']);
        // $content = $utility->filter_SQL($_POST['content']);
        $title = $_POST['title'];
        $content = $_POST['content'];

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
    if(!empty($_FILES['imageFile']) && !empty($_FILES['imageFile']['name'][0])) {

        for($i = 0; $i < count($_FILES['imageFile']['name']); $i++) {

            $tmp_name = $_FILES['imageFile']['tmp_name'][$i];
            $name = $_FILES['imageFile']['name'][$i];

            $dirPath = ROOT_PATH . '/img' . '/' . date('Ymd');

            if(!file_exists($dirPath)) { // 경로 폴더가 없을 경우 폴더 생성
                mkdir($dirPath, 0777);
            }

            $extension = pathinfo($name, PATHINFO_EXTENSION); // 업로드 된 파일의 확장자 추출
            $extensionArr = array('jpeg', 'bmp', 'gif', 'png');

            if(in_array($extension, $extensionArr)) { // 이미지 확장자 체크
                echo ("
                    <script>
                        alert('이미지 파일만 첨부 가능합니다.');
                        go.history(-1);
                    </script>
                ");

                exit;
            }

            $size = $_FILES['imageFile']['size'][$i];

            if($size > 10000) { // 파일 크기 체크
                echo ("
                    <script>
                        alert('파일의 크기는 10000바이트 이하만 가능합니다.');
                        go.history(-1);
                    </script>
                ");

                exit;
            }


            $serverName = $utility->getUUID() . ".$extension"; // 중복되지 않을 파일 이름 생성
            $path = '/loginboard2/img/' . date('Ymd') . "/$serverName";
            $dirPath .= "/$serverName";
            
            $up = move_uploaded_file($tmp_name, $dirPath); // 지정 경로로 파일 업로드

            $image = array(
                'boardId' => $boardId,
                'serverName' => $serverName,
                'originalName' => $name,
                'path' => $path,
                'size' => $size
            );

            if(!$dao->insertImage($image)) {
                echo ("
                <script>
                    alert('파일이 정상적으로 등록되지 않았습니다.');
                    go.history(-1);
                </script>
                ");
            } 
            else {
                echo ("
                <script>
                    location.href = '/loginboard2/controller/board/BoardListController.php?no=$no';
                </script>
                ");
            }
        }
        
    }
    echo ("
    <script>
        location.href = '/loginboard2/controller/board/BoardListController.php?no=$no';
    </script>
    ");