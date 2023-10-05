<?php
include DAO_PATH . '/Common.DAO.php';
class CategoryDAO {

    private $conn;

    public function __construct(){
        $this->conn = mysqli_connect("localhost", "root", "password", "mysql");
    }

    public function createCategory($category) {

        $query = ("
            INSERT INTO category (
                name,
                content
            )
            values (
                ?, ?
            )
        ");
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $category['name'], $category['content']);
        return $stmt->execute();
    }

    public function getCategoryList() {

        $query = 'SELECT id, name, content FROM category ORDER BY id DESC';
        
        $result = mysqli_query($this->conn, $query);

        $listResult = array();
        while($row = mysqli_fetch_array($result)) {

            array_push($listResult, $row);

        }

        return $listResult;
    }

    public function getCategoryListCnt() {
        
        $query = 'SELECT COUNT(*) AS count FROM category';

        $result = mysqli_query($this->conn, $query);

        $row = mysqli_fetch_array($result);

        return $row['count'];
    }
}