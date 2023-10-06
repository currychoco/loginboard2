<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
require_once DAO_PATH . '/Common.DAO.php';
class MenuDAO extends common\CommonDAO{

    public function __construct(){
        parent::__construct();
    }

    public function getMenuList() {

        $query = ("
            SELECT 
                m.id,
                m.name,
                m.content,
                m.parent_id,
                m.category_id,
                m.order,
                c.name as category
            FROM menu m
            INNER JOIN category c
            ON m.category_id = c.id
            WHERE m.visible = 1;
        ");

        $result = mysqli_query($this->conn, $query);

        $listResult = array();
        while($row = mysqli_fetch_array($result)) {

            array_push($listResult, $row);

        }

        return $listResult;
    }

    public function createMenu($menu) {

        $query = ("
            INSERT INTO menu (
                name,
                content,
                category_id,
                visible
            )
            values (
                ?, ?, ?, ?
            )
        ");
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssis", $menu['name'], $menu['content'], $menu['categoryId'], $menu['visible']);
        return $stmt->execute();
    }

    public function getMenuById($menuId) {
        
        $query = ("
            SELECT
                m.id,
                m.name,
                m.category_id,
                m.content,
                m.only_menu,
                m.visible,
                c.name as category
            FROM menu m
            INNER JOIN category c
            ON m.category_id = c.id
            WHERE m.id = ?
        ");

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $menuId);
        $stmt->execute();
        
        $result = $stmt->get_result();

        $row = mysqli_fetch_array($result);

        return $row;
    }

    public function updateMenuById($menu) {

        $query = ("
            UPDATE menu
            SET 
                name = ?,
                category_id = ?,
                content = ?,
                only_menu = ?,
                visible = ?
            WHERE id = ?
        ");

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sisssi', $menu['name'], $menu['categoryId'], $menu['content'], $menu['onlyMenu'], $menu['visible'], $menu['id']);

        return $stmt->execute();
    }
}