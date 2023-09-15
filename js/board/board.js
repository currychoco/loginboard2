pagination();

function pagination(){

    var no = $('input').val();

    $.ajax({
        url : '/loginboard2/common/pagination.php',
        type : 'GET',
        data : {
            no : no
        },
        dataType : 'html'
    })
    .done(function(data) {
        console.log(data);
    })
}