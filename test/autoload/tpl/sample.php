<?php include_once('../autoload.php'); ?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>페이지</title>
</head>
<body>
    
    <h3>오토로드 테스트</h3>

    <?php

        $banana = new Banana('바나바');

        $apple = new Apple('사과');

        echo $banana->getName();

        echo "<br />";

        echo $apple->getName();

    ?>

</body>

</html>