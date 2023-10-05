<?php
include DAO_PATH . '/Common.DAO.php';
class MenuDAO extends CommonDAO {

    public function __construct(){
       parent::__construct();
    }

    public function getMenuList() {

        $query = ("
            SELECT 
                id,
                name,
                content,
                parent_id,
                visible
            FROM menu
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