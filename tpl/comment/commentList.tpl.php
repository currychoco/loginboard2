<?php
    for($i = 0; $i < count($listResult); $i++) {
?>

<div>
    <div>
        <span><?=$listResult[$i]['user_id']?></span>&nbsp;
        <span><?=$listResult[$i]['reg_date']?></span>
    </div>
    
    <div>

        <div>
            <pre style='width:50%; margin:0px'><?=$listResult[$i]['comment']?></pre>
        </div>

        <div>
            <?php

                if(!empty($user) && !empty($user['no'])) { 
                    if($listResult[$i]['user_id'] == $user['userId']) {

            ?>
                    <span><a>수정</a></span>&nbsp;|&nbsp;<span><a>삭제</a></span>       

            <?php
                    }
                } 
            ?>
        </div>
    </div>
</div>

<?php
    }
?>