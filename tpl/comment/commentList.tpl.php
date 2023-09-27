<?php
    for($i = 0; $i < count($listResult); $i++) {
?>

<div>
    <div>
        <span><?=$listResult[$i]['user_id']?></span>&nbsp;
        <span><?=$listResult[$i]['reg_date']?></span>
    </div>
    
    <div>

        <div id="readComment<?=$listResult[$i]['id']?>">
            <pre style='width:50%; margin:0px'><?=$listResult[$i]['comment']?></pre>
        </div>
        <div>
            <form id="updateComment<?=$listResult[$i]['id']?>" style='display:none'>
                <div class="form-inline" style="margin-bottom: 15px">
                    <textarea class='form-control' id="comment<?=$listResult[$i]['id']?>" cols=80 rows=2><?=$listResult[$i]['comment']?></textarea>
                    <input type='button' class='btn btn-warning' onclick="updateComment(<?=$listResult[$i]['id']?>)" value='댓글수정'>
                    <input type='button' class='btn' id='cancelUpdate' value='수정취소'>
                    <input type='hidden' id="clickAnswer<?=$listResult[$i]['id']?>" value=1>
                </div>
            </form>
        </div>

        <div>

            <span><a onclick="getAnswerList(<?=$listResult[$i]['id']?>)">답글(<?=$listResult[$i]['answer']?>)</a></span>
            

            <?php

                if(!empty($user) && !empty($user['no'])) { 
                    if($listResult[$i]['user_id'] == $user['userId']) {

            ?>
                    &nbsp;|&nbsp;
                    <span><a onclick="toUpdateComment(<?=$listResult[$i]['id']?>)">수정</a></span>
                    &nbsp;|&nbsp;
                    <span><a onclick="toDeleteComment(<?=$listResult[$i]['id']?>)">삭제</a></span>       

            <?php
                    }
                } 
            ?>
        </div>

        <!-- 답글 영역 -->
        <div>
            <div id="answerList<?=$listResult[$i]['id']?>"></div>
        </div>
    </div>
</div>
<?php
    }
?>

