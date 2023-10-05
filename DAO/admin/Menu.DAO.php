<?php
include DAO_PATH . '/Common.DAO.php';
class MenuDAO {

    private $conn;

    public function __construct(){
        $this->conn = mysqli_connect("localhost", "root", "password", "mysql");
    }


    public function getMenuList() {

        $query = ("
            SELECT 
                m.id,
                m.name,
                m.content,
                m.parent_id,
                m.visible,
                m.order,
                c.name as category
            FROM menu m
            INNER JOIN category c
            ON m.category_id = c.id
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
}