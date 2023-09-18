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
    })
}