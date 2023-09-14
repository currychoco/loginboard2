<?php
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