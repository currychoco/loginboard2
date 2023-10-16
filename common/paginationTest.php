<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
    require_once ROOT_PATH . '/common/Utility.php';

    $utility = new Utility();

    $pageSize = $utility->filter_SQL($_GET['pageSize']);
    $pageListSize = $utility->filter_SQL($_GET['pageListSize']);
    $totalRow = $utility->filter_SQL($_GET['totalRow']);
    $no = $utility->filter_SQL($_GET['no']);
    $keyword = $utility->filter_SQL($_GET['keyword']);
    $search = $utility->filter_SQL($_GET['search']);
    $category = $utility->filter_SQL($_GET['category']);
    $menu = $utility->filter_SQL($_GET['menu']);

    $firstNo = ($no - 1) * $pageSize;

    $totalPage = ceil($totalRow / $pageSize);

    $currentPage = ceil(($firstNo + 1) / $pageSize);

    $startPage = floor(($currentPage - 1) / $pageListSize) * $pageListSize + 1;

    $endPage = $startPage + $pageListSize - 1;

    if($totalPage < $endPage){
        $endPage = $totalPage;
    }
    if($startPage >= $pageListSize){
        $prevList = ($startPage - 2) * $pageSize;
        echo "<a href=\"/loginboard2/controller/board/BoardListController.php?no=$prevList&search=$search&keyword=$keyword&category=$category&menu=$menu\">◀</a>\n";
    }

    for($i = $startPage; $i <= $endPage; $i++){
        $page = ($i - 1) * $pageSize;
        if($firstNo != $page){
            echo "<a href=\"/loginboard2/controller/board/BoardListController.php?no=$i&search=$search&keyword=$keyword&category=$category&menu=$menu\">";
        }

        echo " $i ";

        if($firstNo != $page){
            echo "</a>";
        }
    }

    if($totalPage > $endPage){
        $nextList = $endPage * $pageSize;
        echo "<a href=\"/loginboard2/ntroller/board/BoardListController.php?no=$nextList&search=$search&keyword=$keyword&category=$category&menu=$menu\">▶</a>\n";
    }