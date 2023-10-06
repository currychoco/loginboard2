function header() {

    $.ajax({
        url : '/loginboard2/controller/HeaderController.php',
        dataType : 'html',

        success : function(data) {
            $('#header').append(data);
        },
        error : function(request) {
            console.log(request.responseText);
        }
    })
}