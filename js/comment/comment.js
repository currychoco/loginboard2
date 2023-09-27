$(function() {
    getCommentList();


    if($('#userId').val()) {
        $('#commentForm').show();   
    }

    $('#update').click(function() {
        toUpdateButton();
    });

    $('#toList').click(function() {
        toListButton();
    });

    $('#delete').click(function() {
        deleteBoard();
    });

    $('#writeComment').click(function() {
        writeComment();
    });

    $('#commentList').on('click', '#cancelUpdate', function(){
        getCommentList();
    });
})

function writeComment() {

    var comment = $('#comment').val();
    var boardId = $('#boardId').val();

    if(comment < 2 || comment > 255) {
        alert('댓글은 2자 이상, 255자 이하만 가능합니다.');
        return;
    }

    $.ajax({
        url : '/loginboard2/process/comment/write.php',
        type : 'POST',
        data : {
            boardId : boardId,
            comment : comment
        },
        dataType : 'json',

        success : function(data) {
            
            if(data.result) {
                $('#comment').val('');
                getCommentList();
            }
            else {
                alert(data.msg);
            }

        },
        error : function(request) {
            console.log(request.responseText);
        }
    });
}

function getCommentList() {

    var boardId = $('#boardId').val();

    $.ajax({
        url : '/loginboard2/controller/comment/CommentListController.php',
        type : 'POST',
        data : {
            boardId : boardId
        },
        dataType : 'html',

        success : function(data) {
            $('#commentList').empty();
            $('#commentList').append(data);
        },
        error : function(request) {
            console.log(request.responseText);
        }
    });
}

function toUpdateComment(id) {
    
    var read = 'readComment' + id;
    var update = 'updateComment' + id;

    $('#' + read).hide();
    $('#' + update).show();

}

function updateComment(commentId) {
    
    var comment = $('#comment' + commentId).val();

    if(comment < 2 || comment > 255) {
        alert('댓글은 2자 이상, 255자 이하만 가능합니다.');
        return;
    }
    
    $.ajax({
        url : '/loginboard2/process/comment/update.php',
        type : 'POST',
        data : {
            commentId : commentId,
            comment : comment
        },
        dataType : 'json',

        success : function(data) {

            if(data.result) {
                getCommentList();
            }
            else {
                alert(data.msg);
            }
        },
        error : function(request) {
            console.log(request.responseText);
        }
    });
}

function toDeleteComment(commentId) {
    
    if(!confirm('댓글을 삭제하시겠습니까?')) {
        return ;
    }

    $.ajax({
        url : '/loginboard2/process/comment/delete.php',
        type : 'POST',
        data : {
            commentId : commentId
        },
        dataType : 'json',

        success : function(data) {

            if(data.result){
                getCommentList();
            }
            else {
                alert(data.msg);
            }
        },
        error : function(request) {
            console.log(request.responseText);
        }
    })
}

function getAnswerList(commentId) {

    var clickAnswer = $('#clickAnswer' + commentId).val();
    console.log(clickAnswer);

    if(clickAnswer == 1) {

        $('#answerList' + commentId).empty();

        $.ajax({
            url : '/loginboard2/controller/comment/AnswerListController.php',
            type : 'POST',
            data : {
                commentId : commentId
            },
            dataType : 'html',

            success : function(data) {

                $('#answerList' + commentId).append(data);

                
                $('input[id^="clickAnswer_"]').each(function(data) {
                    console.log(data);
                    var _thisId = $(this).attr('id');
                });


            },
            error : function(request) {
                console.log(request.responseText);
            }

        });

        $('#clickAnswer' + commentId).val(2);

    }
    else {
        $('#answerList' + commentId).empty();
        $('#clickAnswer' + commentId).val(1);
    }

}

function writeAnswer(commentId) {

    var boardId = $('#boardId').val();
    var comment = $('#answer' + commentId).val();

    if(comment < 2 || comment > 255) {
        alert('댓글은 2자 이상, 255자 이하만 가능합니다.');
        return;
    }

    console.log(commentId);

    $.ajax({
        url : '/loginboard2/process/comment/write.php',
        type : 'POST',
        data : {
            boardId : boardId,
            commentId : commentId,
            comment : comment,
            parentId : commentId
        },
        dataType : 'json',

        success : function(data) {
            console.log(data);
        },
        error : function(request) {
            console.log(request.responseText);
        }
        
    });
}

function toUpdateAnswer(answerId) {

    $('#readAnswer' + answerId).hide();
    $('#updateAnswer' + answerId).show();
}