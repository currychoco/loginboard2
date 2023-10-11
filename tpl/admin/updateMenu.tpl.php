<!DOCTYPE html>
<html>
	<head>
	    <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/head.php"; ?>
        <script src='/loginboard2/js/admin/admin.js'></script>
        <script>
            $(function() {

                getOnlyMenuList();

                $('#updateMenu').click(function() {
                    updateMenu();
                });

                $('#categoryId').on('change', function() {
                    getOnlyMenuList();
                });

                $('#toMenuListButton').click(function() {
                    toMenuList();
                });

            });
        </script>
	</head>
	<body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/admin/adminHeader.php'?>

        <div class="container body-container">
            <h3 class="title">메뉴 수정</h3>

            <form id = "updateMenuForm">
                <table class='table'>
                    <tr>
                        <th>메뉴명</th>
                        <td><input class='form-control' type='text' id='name' name='name' value="<?=$menu['name']?>"></td>
                    </tr>
                    <tr>
                        <th>카테고리</th>
                        <td>
                            <select class='form-control' id='categoryId' name='categoryId'>
                                <?php for($i = 0; $i < count($categoryList); $i++) { ?>
                                    <option value="<?=$categoryList[$i]['id']?>" <?php if($menu['category_id'] == $categoryList[$i]['id']) {?> selected='selected' <?php }?> ><?=$categoryList[$i]['name']?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>상위 메뉴</th>
                        <td id='menuList'></td>
                    </tr>
                    <tr>
                        <th>메뉴 설명</th>
                        <td><textarea class='form-control' name="content" id="content" cols=65 rows=4><?=$menu['content']?></textarea></td>
                    </tr>
                    <tr>
                        <th>하위 메뉴 생성</th>
                        <td>
                            <select class='form-control' id='onlyMenu' name='onlyMenu'>
                                <option value='1' <?php if($menu['only_menu'] == 1) { ?> selected='selected' <?php } ?>>하위 메뉴 생성 O (중간 메뉴로 사용)</option>
                                <option value='0' <?php if($menu['only_menu'] == 0) { ?> selected='selected' <?php } ?>>하위 메뉴 생성 X (글 기재 메뉴로 사용)</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>메뉴 보이기</th>
                        <td>
                            <select class='form-control' id='visible' name='visible'>
                                <option value='1' <?php if($menu['visible'] == 1) { ?> selected='selected' <?php } ?>>보이기</option>
                                <option value='0' <?php if($menu['visible'] == 0) { ?> selected='selected' <?php } ?>>숨김</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align:right;'>
                            <input type='button' class='btn btn-primary' id='updateMenu' value='수정'>
                            <input type='button' class='btn' id='toMenuListButton' value='목록'>
                        </td>
                    </tr>
                </table>
                <input type='hidden' id='id' name='id' value="<?=$menu['id']?>">
                <input type='hidden' id='menu' name='menu' value="<?=$menu['parent_id']?>">
            </form>
        </div>
	</body>
</html>