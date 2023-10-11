function pagination(){

    var no = $('#no').val();
    var totalRow = $('#totalRow').val();
    var pageSize = $('#pageSize').val();
    var pageListSize = $('#pageListSize').val();

    var tmpKeyword = $('#keyword').val();
    var reg = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
    var keyword = tmpKeyword.replace(reg, '');

    var search = $('#search').val();

    $.ajax({
        url : '/loginboard2/common/paginationTest.php',
        type : 'GET',
        data : {
            totalRow : totalRow,
            no : no,
            pageSize : pageSize,
            pageListSize : pageListSize,
            search : search,
            keyword : keyword
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

function setList(type) {
    
    var reg = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
    var tmpKeyword = $('#keyword').val();
    var no = $('#no').val();
    var keyword = tmpKeyword.replace(reg, '');

    location.href = '/loginboard2/controller/board/BoardListController.php?no=' + no + '&keyword=' + keyword + '&list=' + type;

}

function checkLogin() {
    var login = $('#checkLogin').val();
    var no = $('#no').val();

    if(!login) {
        alert('로그인이 필요합니다.');
        location.href = '/loginboard2/controller/board/BoardListController.php?no=' + no;
    }
}

function createBoard() {

    // 유효성 검사
    var title = $('#title').val();
    var content = $('#content').val();
    var menuId = $('#menuId option:selected').val();

    if(title.length < 2 || title.length > 30) {
        alert('제목은 2자 이상 30자 이하여야 합니다.');
        return;
    }
    if(content.length < 1) {
        alert('내용은 1자 이상이어야 합니다.');
        return;
    }
    if(menuId == 0 && !Number.isInteger(menuId)) {
        alert('게시판을 선택해 주십시오.');
        return;
    }

    $('#writeForm').submit();
    
}

function toListButton() {

    var no = $('#no').val();
    var search = $('#search').val();
    var keyword = $('#keyword').val();
    var urlCategoryId = $('#urlCategoryId').val();
    var urlMenuId = $('#urlMenuId').val();

    location.href = '/loginboard2/controller/board/BoardListController.php?no=' + no + '&search=' + search + '&keyword=' + keyword + '&category=' + urlCategoryId + '&menu=' + urlMenuId;

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
    var search = $('#search').val();
    var keyword = $('#keyword').val();
    var urlCategoryId = $('#urlCategoryId').val();
    var urlMenuId = $('#urlMenuId').val();

    location.href = '/loginboard2/controller/board/BoardUpdateController.php?no=' + no + '&boardId=' + boardId;

    var no = $('#no').val();
    var search = $('#search').val();
    var keyword = $('#keyword').val();
    var urlCategoryId = $('#urlCategoryId').val();
    var urlMenuId = $('#urlMenuId').val();

    location.href = '/loginboard2/controller/board/BoardUpdateController.php?no=' + no + '&search=' + search + '&keyword=' + keyword + '&category=' + urlCategoryId + '&menu=' + urlMenuId + '&boardId=' + boardId;

}

function updateButton() {

    // 유효성 검사
    var title = $('#title').val();
    var content = $('#content').val();

    if(title.length < 2 || title.length > 30) {
        alert('제목은 2자 이상 30자 이하여야 합니다.');
        return;
    }
    if(content.length < 1) {
        alert('내용은 1자 이상이어야 합니다.');
        return;
    }

    $('#updateForm').submit();
}

function deleteBoard() {

    if(!confirm('삭제하시겠습니까?')) {
        return;
    }

    var boardId = $('#boardId').val();
    var no = $('#no').val();

    $.ajax({
        url : '/loginboard2/process/board/delete.php',
        type : 'GET',
        data : {
            boardId : boardId
        },
        dataType : 'json',

        success : function(data) {

            if(data) {
                alert('삭제되었습니다.');
                location.href = '/loginboard2/controller/board/BoardListController.php?no=' + no;
            }
            else {
                alert('삭제에 실패하였습니다.');
            }
        },
        error : function(request, status, error) {
            console.log(request.responseText);
        }
    });
}

function search() {

    var reg = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
    var tmpKeyword = $('#keyword').val();

    var keyword = tmpKeyword.replace(reg, '');

    var search = $('#search').val();

    location.href = '/loginboard2/controller/board/BoardListController.php?search=' + search + '&keyword=' + keyword;

}