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
    location.href = '/loginboard2/controller/admin/CreateMenuController.php';
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

function updateCategory() {

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

        url : '/loginboard2/process/admin/updateCategory.php',
        type : 'POST',
        data : $('#updateCategoryForm').serialize(),
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

function updateMenu() {

    var reg = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
    var tmpName = $('#name').val();
    var content = $('#content').val();

    var name = tmpName.replace(reg, '');

    if(name.length < 2 || name.length > 20) {
        alert('메뉴 이름은 2자 이상, 20자 이하만 가능합니다.');
        return;
    }

    if(content.length > 100) {
        alert('메뉴 내용은 100자 이하만 가능합니다.');
        return;
    }

    $.ajax({
        url : '/loginboard2/process/admin/updateMenu.php',
        type : 'POST',
        data : $('#updateMenuForm').serialize(),
        dataType : 'json',

        success : function(data) {

            if(data.result == 1) {
                location.href = '/loginboard2/controller/admin/MenuListController.php';
            }
            else if(data.result == -1) {
                alert(data.msg);
                return;
            }
            else if(data.result == -2){
                alert(data.msg);
                location.href = '/loginboard2/controller/user/UserLoginController.php';
            }
            else{
                alert(data.msg);
            }
        },
        error : function(request) {
            console.log(request.responseText);
        }
    });
}

function toUpdateMenu() {
    var menuId = $('#menuId').val();
    location.href = '/loginboard2/controller/admin/UpdateMenuController.php?type=update&menuId=' + menuId;
}

function toUpdateCategory() {
    var categoryId = $('#categoryId').val();
    location.href = '/loginboard2/controller/admin/UpdateCategoryController.php?type=update&categoryId=' + categoryId;
}

function deleteCategory() {

    if(!confirm('해당 카테고리를 삭제하시겠습니까?')) {
        return;
    }

    var categoryId = $('#categoryId').val();

    $.ajax({
        url : '/loginboard2/process/admin/deleteCategory.php',
        type : 'POST',
        data : {
            categoryId : categoryId
        },
        dataType : 'json',

        success : function(data) {
            
            if(data.result) {
                alert(data.msg);
                location.href = '/loginboard2/controller/admin/CategoryListController.php';
            }
            else {
                alert(data.msg)
            }
        },
        error : function(request) {
            console.log(request.responseText);
        }
    });
}

function deleteMenu() {

    if(!confirm('해당 메뉴를 삭제하시겠습니까?')) {
        return;
    }

    var menuId = $('#menuId').val();

    $.ajax({
        url : '/loginboard2/process/admin/deleteMenu.php',
        type : 'POST',
        data : {
            menuId : menuId
        },
        dataType : 'json',

        success : function(data) {
            
            if(data.result) {
                alert(data.msg);
                location.href = '/loginboard2/controller/admin/MenuListController.php';
            }
            else {
                alert(data.msg)
            }
        },
        error : function(request) {
            console.log(request.responseText);
        }
    });
}