<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
require_once DAO_PATH . '/Common.DAO.php';
class CategoryDAO extends common\CommonDAO{

    public function __construct(){
        parent::__construct();
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