<!DOCTYPE html>
<html>
	<head>
	    <?php include $_SERVER['DOCUMENT_ROOT']."/loginboard2/common/head.php"; ?>
        <script src='/loginboard2/js/admin/admin.js'></script>
        <script>
            $(function() {
                $('#toUpdateMenu').click(function() {
                    toUpdateMenu();
                });
                $('#deleteMenu').click(function() {
                    deleteMenu();
                });
            });
        </script>
	</head>
	<body>
        <!-- header -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/admin/adminHeader.php'?>

        <div class="container body-container">
            <h3 class="title">메뉴</h3>

            <form id = "readMenuForm">
                <input type='hidden' id='menuId' name='menuId' value="<?=$menu['id']?>">
                <table class='table'>
                    <tr>
                        <th>메뉴명</th>
                        <td><input class='form-control' type='text' id='name' name='name' value="<?=$menu['name']?>" readonly></td>
                    </tr>
                    <tr>
                        <th>카테고리</th>
                        <td><input class='form-control' type='text' id='name' name='name' value="<?=$menu['category']?>" readonly></td>
                    </tr>
                    <tr>
                        <th>메뉴 설명</th>
                        <td><textarea class='form-control' name="content" id="content" cols=65 rows=4 readonly><?=$menu['content']?></textarea></td>
                    </tr>
                    <tr>
                        <th>하위 메뉴 생성</th>
                        <td>
                            <select class='form-control' id='onlyMenu' name='onlyMenu' disabled>
                                <option value='1' <?php if($menu['only_menu'] == 1) { ?> selected='selected' <?php } ?>>하위 메뉴 생성 O (중간 메뉴로 사용)</option>
                                <option value='0' <?php if($menu['only_menu'] == 0) { ?> selected='selected' <?php } ?>>하위 메뉴 생성 X (글 기재 메뉴로 사용)</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>메뉴 보이기</th>
                        <td>
                            <select class='form-control' id='visible' name='visible' disabled>
                                <option value='1' <?php if($menu['visible'] == 1) { ?> selected='selected' <?php } ?>>보이기</option>
                                <option value='0' <?php if($menu['visible'] == 0) { ?> selected='selected' <?php } ?>>숨김</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' style='text-align:right;'>
                            <input type='button' class='btn btn-primary' id='toUpdateMenu' value='수정하기'>
                            <input type='button' class='btn btn-danger' id='deleteMenu' value='삭제'>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
	</body>
</html>