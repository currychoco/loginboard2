function pagination(){

    var no = $('#no').val();
    var totalRow = $('#totalRow').val();
    var pageSize = $('#pageSize').val();
    var pageListSize = $('#pageListSize').val();

    $.ajax({
        url : '/loginboard2/common/paginationTest.php',
        type : 'GET',
        data : {
            totalRow : totalRow,
            no : no,
            pageSize : pageSize,
            pageListSize : pageListSize
        },
        dataType : 'html'
    })
    .done(function(data) {
        $('#pagination').append(data);
    })
    .fail(function(textStatus) {
        console.log(textStatus);
    });
}

function getBoardList() {
    
    var no = $('#no').val();
    var pageSize = $('#pageSize').val();

    $.ajax({
        url : '/loginboard2/controller/board/BoardListControllerTest.php',
        type : 'GET',
        data : {
            no : no,
            pageSize : pageSize
        },
        dataType : 'html'
    })
    .done(function(data) {
        $('tbody').append(data);
    })
    .fail(function(textStatus) {
        console.log(textStatus);
    });
}

function checkLogin() {
    var login = $('#checkLogin').val();
    var no = $('#no').val();

    if(!login) {
        alert('로그인이 필요합니다.');
        location.href = '/loginboard2/controller/board/BoardListController.php?no=' + no;
    }
}

function writeButton() {

    $('#writeForm').submit();
    
}

function toListButton() {

    var no = $('#no').val();
    location.href = '/loginboard2/controller/board/BoardListController.php?no=' + no;

}

function checkWriter() {

    checkLogin();

    var no = $('#no').val();
    var writer = $('#checkWriter').val();

    if(!writer) {
        alert('본인이 작성할 글만 수정 가능합니다.');
        location.href = '/loginboard2/controller/board/BoardListController.php?no=' + no;
    }

}

function toUpdateButton() {

    var no = $('#no').val();
    var boardId = $('#boardId').val();

    location.href = '/loginboard2/controller/board/BoardUpdateController.php?no=' + no + '&boardId=' + boardId;

}