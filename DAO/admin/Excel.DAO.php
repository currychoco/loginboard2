<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
require_once DAO_PATH . '/Common.DAO.php';

class ExcelDAO extends common\CommonDAO{

    public function __construct(){
        parent::__construct();
    }

    public function insertExcelInfo($info) {

        $this->conn->begin_transaction();

        $query = ("
            INSERT INTO login_board (
                title,
                content,
                user_no,
                menu_id
            )
            VALUES (
                ?, ?, ?, ?
            )
        ");

        $stmt = $this->conn->prepare($query);

        $title = '';
        $content = '';
        $userNo = 0;
        $menuId = 0;
        $stmt->bind_param('ssii', $title, $content, $userNo, $menuId);
        
        try {

            foreach($info as $list) {
                $title = $list['title'];
                $content = $list['content'];
                $userNo = $list['user_no'];
                $menuId = $list['menu_id'];
    
                $stmt->execute();
            }

            $this->conn->commit();

            return true;
        }       
        catch(mysqli_sql_exception $exception) {
            $this->conn->rollback();
            return false;
        } 

    }
    
}