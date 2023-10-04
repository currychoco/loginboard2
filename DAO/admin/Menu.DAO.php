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
                parent_id
            FROM menu
        ");

        $result = mysqli_query($this->conn, $query);

        $listResult = array();
        while($row = mysqli_fetch_array($result)) {

            array_push($listResult, $row);

        }

        return $listResult;
    }
}