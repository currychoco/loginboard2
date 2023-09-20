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

    $no = $('#no').val();

    if(confirm('글을 저장하지 않고 현재 페이지를 나가겠습니까?')) {
        location.href = '/loginboard2/controller/board/BoardListController.php?no=' + $no;
    }

}