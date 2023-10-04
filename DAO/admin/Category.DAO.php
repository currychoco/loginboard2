<?php
include DAO_PATH . '/Common.DAO.php';
class CategoryDAO extends CommonDAO {

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
}