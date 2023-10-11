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

    $pageSize = PAGE_SIZE;
    $pageListSize = PAGE_LIST_SIZE;

    $totalPage = ceil($totalRow / $pageSize);

    $currentPage = ceil(($no + 1) / $pageSize);

    $startPage = floor(($currentPage - 1) / $pageListSize) * $pageListSize + 1;

    $endPage = $startPage + $pageListSize - 1;

    if($totalPage < $endPage){
        $endPage = $totalPage;
    }
    if($startPage >= $pageListSize){
        $prevList = ($startPage - 2) * $pageSize;
        echo "<a href=\"$_SERVER[PHP_SELF]?no=$prevList\">◀</a>\n";
    }

    for($i = $startPage; $i <= $endPage; $i++){
        $page = ($i - 1) * $pageSize;
        if($no != $page){
            echo "<a href=\"$_SERVER[PHP_SELF]?no=$page\">";
        }

        echo " $i ";

        if($no != $page){
            echo "</a>";
        }
    }

    if($totalPage > $endPage){
        $nextList = $endPage * $pageSize;
        echo "<a href=\"$_SERVER[PHP_SELF]?no=$nextList\">▶</a>\n";
    }