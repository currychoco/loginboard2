<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/Utility.php';

    $utility = new Utility();

    $pageSize = $utility->filter_SQL($_GET['pageSize']);
    $pageListSize = $utility->filter_SQL($_GET['pageListSize']);
    $totalRow = $utility->filter_SQL($_GET['totalRow']);
    $no = $utility->filter_SQL($_GET['no']);
    $search = $utility->filter_SQL($_GET['search']);

    $totalPage = ceil($totalRow / $pageSize);

    $currentPage = ceil(($no + 1) / $pageSize);

    $startPage = floor(($currentPage - 1) / $pageListSize) * $pageListSize + 1;

    $endPage = $startPage + $pageListSize - 1;

    if($totalPage < $endPage){
        $endPage = $totalPage;
    }
    if($startPage >= $pageListSize){
        $prevList = ($startPage - 2) * $pageSize;
        echo "<a href=\"/loginboard2/controller/board/BoardListController.php?no=$prevList&search=$search\">◀</a>\n";
    }

    for($i = $startPage; $i <= $endPage; $i++){
        $page = ($i - 1) * $pageSize;
        if($no != $page){
            echo "<a href=\"/loginboard2/controller/board/BoardListController.php?no=$page&search=$search\">";
        }

        echo " $i ";

        if($no != $page){
            echo "</a>";
        }
    }

    if($totalPage > $endPage){
        $nextList = $endPage * $pageSize;
        echo "<a href=\"/loginboard2/controller/board/BoardListController.php?no=$nextList&search=$search\">▶</a>\n";
    }