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