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
            console.log(data);
            $('#commentList').empty();
            $('#commentList').append(data);
        },
        error : function(request) {
            console.log(request.responseText);
        }
    });
}