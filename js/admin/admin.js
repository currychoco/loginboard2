function toMakeCategory() {
    location.href = '/loginboard2/tpl/admin/createCategoryView.php';
}

function createCategory() {

    var reg = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
    var tmpName = $('#name').val();
    var content = $('#content').val();

    var name = tmpName.replace(reg, '');

    $.ajax({
        url : '/loginboard2/process/admin/createCategory.php',
        type : 'POST',
        data : {
            name : name,
            content : content
        },
        dataType : 'json',

        success : function(data) {

            if(data.result == 1) {
                location.href = '/loginboard2/controller/admin/CategoryListController.php';
            }
            else if(data.result == -1) {
                alert(data.msg);
                return;
            }
            else {
                alert(data.msg);
                location.href = '/loginboard2/controller/user/UserLoginController.php';
            }
        },
        error : function(request) {
            console.log(request.responseText);
        }
    });
}