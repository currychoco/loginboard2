<select class='form-control' id='menuId' name='menuId'>
    <option value='0'>없음</value>
    <?php
        if(count($menuList) > 0) {
            for($i = 0; $i < count($menuList); $i++) {
    ?>
        <option value="<?=$menuList[$i]['id']?>" <?php if($menuId == $menuList[$i]['id']) { ?> selected='selected' <?php } ?>><?=$menuList[$i]['name']?></option>
    <?php
            }
        }
    ?>
</select>