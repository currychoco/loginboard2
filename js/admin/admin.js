function toMakeCategory() {
    location.href = '/loginboard2/tpl/admin/createCategoryView.php';
}

function createCategory() {

    var reg = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
    var tmpName = $('#name').val();
    var content = $('#content').val();

    var name = tmpName.replace(reg, '');

    if(name.length < 2 || name.length > 20) {
        alert('카테고리 이름은 2자 이상, 20자 이하만 가능합니다.');
        return;
    }

    if(content.length > 100) {
        alert('카테고리 내용은 100자 이하만 가능합니다.');
        return;
    }

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

function toMakeMenu() {
    location.href = '/loginboard2/controller/admin/CreateCategoryController.php';
}

function createMenu() {

    var reg = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
    var tmpName = $('#name').val();
    var content = $('#content').val();

    var name = tmpName.replace(reg, '');

    if(name.length < 2 || name.length > 20) {
        alert('카테고리 이름은 2자 이상, 20자 이하만 가능합니다.');
        return;
    }

    if(content.length > 100) {
        alert('카테고리 내용은 100자 이하만 가능합니다.');
        return;
    }

    $.ajax({
        url : '/loginboard2/process/admin/createMenu.php',
        type : 'POST',
        data : $('#menuForm').serialize(),
        dataType : 'json',

        success : function(data) {

            if(data.result == 1) {
                location.href = '/loginboard2/controller/admin/MenuListController.php';
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