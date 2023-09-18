<?php
    $pageSize = $_GET['pageSize'];
    $pageListSize = $_GET['pageListSize'];
    $totalRow = $_GET['totalRow'];
    $no = $_GET['no'];

    $totalPage = ceil($totalRow / $pageSize);

    $currentPage = ceil(($no + 1) / $pageSize);

    $startPage = floor(($currentPage - 1) / $pageListSize) * $pageListSize + 1;

    $endPage = $startPage + $pageListSize - 1;

    if($totalPage < $endPage){
        $endPage = $totalPage;
    }
    if($startPage >= $pageListSize){
        $prevList = ($startPage - 2) * $pageSize;
        echo "<a href=\"/loginboard2/controller/board/BoardListController.php?no=$prevList\">◀</a>\n";
    }

    for($i = $startPage; $i <= $endPage; $i++){
        $page = ($i - 1) * $pageSize;
        if($no != $page){
            echo "<a href=\"/loginboard2/controller/board/BoardListController.php?no=$page\">";
        }

        echo " $i ";

        if($no != $page){
            echo "</a>";
        }
    }

    if($totalPage > $endPage){
        $nextList = $endPage * $pageSize;
        echo "<a href=\"/loginboard2/controller/board/BoardListController.php?no=$nextList\">▶</a>\n";
    }