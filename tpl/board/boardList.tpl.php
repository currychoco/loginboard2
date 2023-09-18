<?php
    for($i = 0; $i < count($listResult); $i++) {
?>
<tr>
    <td>
        <a href="/loginboard/board/read.php?id=<?=$listResult[$i]['id']?>&no=<?=$no?>"><?=$listResult[$i]['id']?></a>
    </td>
    <td>
        <a href="/loginboard/board/read.php?id=<?=$listResult[$i]['id']?>&no=<?=$no?>"><?=$listResult[$i]['title']?></a>
    </td>
    <td>
        <p><?=$listResult[$i]['user_id']?></p>
    </td>
    <td>
        <p><?=$listResult[$i]['reg_date']?></p>
    </td>
    <td>
        <p><?=$listResult[$i]['view_count']?></p>
    </td>
</tr>
<?php
    }
?>