<?php
namespace dao;

require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
require_once DAO_PATH . '/Common.DAO.php';
class Menu extends CommonDAO{

    public function __construct(){
        parent::__construct();
    }

    public function getMenuList() {

        // $query = ("
        //     SELECT 
        //         m.id,
        //         m.name,
        //         m.content,
        //         m.parent_id,
        //         m.category_id,
        //         m.order,
        //         m.only_menu,
        //         m.visible,
        //         c.name as category
        //     FROM menu m
        //     INNER JOIN category c
        //     ON m.category_id = c.id
        // ");

        $query = ("
        WITH RECURSIVE test AS (

            SELECT
                m.id,
                m.name,
                m.content,
                m.parent_id,
                m.category_id,
                m.`order`,
                m.only_menu,
                m.visible,
                m.depth,
                c.name AS category,
                CAST(m.id AS char(100)) AS path
            FROM menu m
            INNER JOIN category c
            ON m.category_id = c.id
            WHERE 
                m.parent_id = 0
            
            UNION ALL
            
            SELECT
                m.id,
                m.name,
                m.content,
                m.parent_id,
                m.category_id,
                m.`order`,
                m.only_menu,
                m.visible,
                m.depth,
                c.name AS category,
                CONCAT(t.path, ',', m.`id`) AS path
            FROM menu m
            INNER JOIN category c
            ON m.category_id = c.id
            INNER JOIN test t ON m.parent_id = t.id
            )
            SELECT * FROM test
        ");

        $result = mysqli_query($this->conn, $query);

        $listResult = array();
        while($row = mysqli_fetch_array($result)) {

            array_push($listResult, $row);

        }

        return $listResult;
    }

    public function createMenu($menu) {

        $order = $this->getMaxOrder($menu['categoryId'], $menu['parentId']);

        $query = ("
            INSERT INTO menu (
                name,
                content,
                category_id,
                parent_id,
                visible,
                only_menu,
                `order`,
                depth
            )
            values (
                ?, ?, ?, ?, ?, ?, ?, ?
            )
        ");
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssiissii", $menu['name'], $menu['content'], $menu['categoryId'], $menu['parentId'], $menu['visible'], $menu['onlyMenu'], $order, $menu['depth']);
        return $stmt->execute();
    }

    public function getMaxOrder($categoryId, $parentId) {

        $order = 1;
        
        $query = ("
            SELECT MAX(`order`) as `order` FROM menu WHERE category_id = ? AND parent_id = ?
        ");
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ii', $categoryId, $parentId);
        $stmt->execute();

        $row = $stmt->get_result();
        $result = mysqli_fetch_array($row);

        if(isset($result['order']) && !empty($result['order'])) {
            $order = $result['order'] + 1;
        }

        return $order;
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
                c.name as category,
                m.depth,
                m.parent_id,
                (SELECT name p FROM menu p WHERE p.id = m.parent_id) AS parent
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
                visible = ?,
                parent_id = ?,
                depth = ?
            WHERE id = ?
        ");

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sisssiii', $menu['name'], $menu['categoryId'], $menu['content'], $menu['onlyMenu'], $menu['visible'], $menu['parentId'], $menu['depth'], $menu['id']);

        return $stmt->execute();
    }

    public function deleteMenuById($menuId) {
        
        $query = 'DELETE FROM menu WHERE id = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $menuId);

        return $stmt->execute();
    }

    public function getOnlyMenuList() {

        $query = 'SELECT id, name FROM menu WHERE only_menu = 1';
        $result = mysqli_query($this->conn, $query);

        $listResult = array();
        while($row = mysqli_fetch_array($result)) {

            array_push($listResult, $row);

        }

        return $listResult;
    }

    public function getMenuListByCategoryId($categoryId, $type) {

        $query = ("
            SELECT
                id,
                name
            FROM menu
            WHERE
                category_id = ?
                AND only_menu = ?
                AND visible = 1
        ");

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('is', $categoryId, $type);
        $stmt->execute();
        $resultList = $stmt->get_result();

        $result = array();
        while($row = mysqli_fetch_array($resultList)) {
            array_push($result, $row);
        }

        return $result;
    }

    public function getMenuListNotOnlyMenu() {

        $query = 'SELECT * FROM menu WHERE visible = 1 AND only_menu = 0';
        
        $tmp = mysqli_query($this->conn, $query);
        
        $result = array();
        while($row = mysqli_fetch_array($tmp)) {
            array_push($result, $row);
        }

        return $result;
    }
}