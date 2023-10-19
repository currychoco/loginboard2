<?php
namespace dao;
use mysqli_sql_exception;

require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
require_once DAO_PATH . '/Common.DAO.php';
class DanawaBoardList extends CommonDAO {

    //생성자 - DB 커넥션 연결
    public function __construct(){
        parent::__construct();
    }

    // 쿼리로 조회된 결과물 배열로 반환
    public function getBoardList($no = 0, $pageSize = PAGE_SIZE, $search='', $keyword='', $menuId = 0) {

        $stmt = null;

        if($search == 'title') { 

            $query = ("
                SELECT 
                    b.id,
                    b.title,
                    b.content,
                    u.user_id,
                    b.reg_date,
                    b.view_count,
                    MIN(i.path) as path
                FROM login_board b
                INNER JOIN board_user u
                ON b.user_no = u.no
                LEFT OUTER JOIN image i
                ON b.id = i.board_id
                WHERE 
                    title like CONCAT('%', ?, '%')
                    AND b.menu_id = ?
                GROUP BY b.id
                ORDER BY id DESC
                LIMIT ?, ?
            ");

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("siii", $keyword, $menuId, $no, $pageSize);
            $stmt->execute();
        }
        else if($search == 'writer') {

            $query = ("
                SELECT 
                    b.id,
                    b.title,
                    b.content,
                    u.user_id,
                    b.reg_date,
                    b.view_count,
                    MIN(i.path) as path
                FROM login_board b
                INNER JOIN board_user u
                ON b.user_no = u.no
                LEFT OUTER JOIN image i
                ON b.id = i.board_id
                WHERE 
                    u.user_id like CONCAT('%', ?, '%')
                    AND b.menu_id = ?
                GROUP BY b.id
                ORDER BY id DESC
                LIMIT ?, ?
            ");

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("siii", $keyword, $menuId, $no, $pageSize);
            $stmt->execute();
        }
        else {

            $query = ("
                SELECT 
                    b.id,
                    b.title,
                    b.content,
                    u.user_id,
                    b.reg_date,
                    b.view_count,
                    i.path
                FROM login_board b
                INNER JOIN board_user u
                ON b.user_no = u.no
                LEFT OUTER JOIN image i
                ON b.id = i.board_id
                WHERE b.menu_id = ?
                GROUP BY b.id
                ORDER BY id DESC
                LIMIT ?, ?
            ");

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("iii", $menuId, $no, $pageSize);
            $stmt->execute();
        }

        
        $result = $stmt->get_result();

        $listResult = array();
        while($row = mysqli_fetch_array($result)) {

            array_push($listResult, $row);

        }

        return $listResult;

    }
    

    // 총 게시글 개수 반환
    public function getBoardListCount($search = '', $keyword = '', $menuId = 0){

        $result = null;

        if($search == 'title') {

            $query = "SELECT COUNT(*) AS count FROM login_board WHERE title LIKE CONCAT('%', ?, '%') AND menu_id = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('si', $keyword, $menuId);
            $stmt->execute();
            $result = $stmt->get_result();

        }
        else if($search == 'writer') {

            $query = ("
                SELECT COUNT(*) AS count
                FROM login_board b
                INNER JOIN board_user u
                ON u.no = b.user_no
                WHERE
                    u.user_id LIKE CONCAT('%', ?, '%')       
                    AND b.menu_id = ?
            ");

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('si', $keyword, $menuId);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        else {

            $query = "SELECT COUNT(*) AS count FROM login_board WHERE menu_id = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('i', $menuId);
            $stmt->execute();
            $result = $stmt->get_result();

        }

        $row = mysqli_fetch_array($result);

        return $row['count'];

    }

    // 게시글 생성
    public function insertBoard($board) {

        $stmt = $this->conn->prepare("
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

        $stmt->bind_param('sssi', $board['title'], $board['content'], $board['no'], $board['menuId']);
        $stmt->execute();

        return $this->conn->insert_id;
    }

    // 이미지 저장
    public function insertImage($image) {

        $stmt = $this->conn->prepare("
            INSERT INTO image (
                board_id,
                server_name,
                original_name,
                path,
                size
            ) 
            VALUES (
                ?, ?, ?, ?, ?
            )
        ");

        $stmt->bind_param('isssi', $image['boardId'], $image['serverName'], $image['originalName'], $image['path'], $image['size']);

        return $stmt->execute();
        
    }

    public function insertImage2($imageList, $boardId) {

        $serverName = '';
        $originalName = '';
        $path = '';
        $size = 0;

        $stmt = $this->conn->prepare("
            INSERT INTO image (
                board_id,
                server_name,
                original_name,
                path,
                size
            ) 
            VALUES (
                ?, ?, ?, ?, ?
            )
        ");
        $stmt->bind_param('isssi', $boardId, $serverName, $originalName, $path, $size);

        foreach($imageList as $image) {

            $serverName = $image['serverName'];
            $originalName = $image['originalName'];
            $path = $image['path'];
            $size = $image['size'];
            $stmt->execute();
        }

        $this->conn->commit();

        return true;
        
    }

    // 게시글 id 기반 하나 불러오기
    public function getBoardById($id) {

        // 게시글
        $stmt = $this->conn->prepare("
            SELECT 
                b.id,
                b.title,
                b.content,
                u.user_id,
                b.reg_date,
                b.view_count,
                b.menu_id,
                m.category_id,
                m.name as menu,
                c.name as category
            FROM login_board b
            INNER JOIN board_user u ON b.user_no = u.no
            INNER JOIN menu m ON b.menu_id = m.`id`
            INNER JOIN category c ON m.`category_id` = c.`id`
            WHERE b.id = ?
        ");
        $stmt->bind_param('i', $id);

        $stmt->execute();
        $result = $stmt->get_result();
        $board = mysqli_fetch_array($result);


        // 이미지
        $image = array();
        $stmt = $this->conn->prepare("
            SELECT
                id,
                board_id,
                server_name,
                original_name,
                path,
                size
            FROM image
            WHERE board_id = ?
        ");
        $stmt->bind_param('i', $board['id']);
        $stmt->execute();

        $result = $stmt->get_result();

        while($row = mysqli_fetch_array($result)) {

            array_push($image, $row);

        }

        return array('board' => $board, 'image' => $image);
    }

    // 게시글 수정
    public function updateBoardById($boardId, $title, $content) {

        $stmt = $this->conn->prepare("
            UPDATE login_board
            SET
                title = ?,
                content = ?,
                mod_date = now()
            WHERE id = ?
        ");

        $stmt->bind_param('ssi', $title, $content, $boardId);

        return $stmt->execute();
    }

    // 이미지 삭제
    public function deleteImageById($boardId) {

        $stmt = $this->conn->prepare("DELETE FROM image WHERE board_id = ?");
        $stmt->bind_param("i", $boardId);

        $stmt->execute();
    }

    // 게시글 삭제
    public function deleteBoardById($boardId) {

        $stmt = $this->conn->prepare("DELETE FROM login_board where id = ?");
        $stmt->bind_param("i", $boardId);

        return  $stmt->execute();

    }

    // 게시글 조회수
    public function countView($boardId) {

        $query = 'update login_board set view_count=view_count+1 where id= ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $boardId);

        return $stmt->execute();

    }

    // 캐시 저장
    public function getBoardListForCache($menuId) {

        $query = ("
            SELECT 
                b.id,
                b.title,
                b.menu_id,
                (SELECT COUNT(*) FROM comment c WHERE c.board_id = b.id) as comment_cnt,
                b.view_count
            FROM
                login_board b
            WHERE
                b.menu_id = ?
            ORDER BY b.id DESC
            LIMIT 5
        ");

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $menuId);
        $stmt->execute();

        $tmp = $stmt->get_result();

        $result = array();
        while($row = mysqli_fetch_array($tmp)) {

            array_push($result, $row);

        }

        return $result;
    }

    public function getBoardListbyViewCnt() {

        $query = ('
            SELECT 
                b.id,
                b.title,
                b.menu_id,
                (SELECT COUNT(*) FROM comment c WHERE c.board_id = b.id) as comment_cnt,
                b.view_count,
                (SELECT m.name FROM menu m WHERE m.id = b.menu_id) as menu,
                (SELECT m.category_id FROM menu m WHERE m.id = b.menu_id) as category_id
            FROM
                login_board b
            ORDER BY b.view_count DESC
            LIMIT 5
        ');

        $tmp = mysqli_query($this->conn, $query);
        $result = array();
        while($row = mysqli_fetch_array($tmp)) {
            array_push($result, $row);
        }

        return $result;
    }

    public function getBoardListByComment() {

        $query = ('
            SELECT 
                b.id,
                b.title,
                b.menu_id,
                (SELECT COUNT(*) FROM comment c WHERE c.board_id = b.id) as comment_cnt,
                b.view_count,
                (SELECT m.name FROM menu m WHERE m.id = b.menu_id) as menu,
                (SELECT m.category_id FROM menu m WHERE m.id = b.menu_id) as category_id
            FROM
                login_board b
            ORDER BY comment_cnt DESC
            LIMIT 5
        ');

        $tmp = mysqli_query($this->conn, $query);
        $result = array();
        while($row = mysqli_fetch_array($tmp)) {
            array_push($result, $row);
        }

        return $result;
    }
    
    public function getBoardListForExcel() {
        $query = ("
            SELECt 
                id,
                title,
                content,
                user_no,
                reg_date,
                mod_date,
                view_count,
                menu_id
            FROM login_board
            ORDER BY id
        ");

        $tmp = mysqli_query($this->conn, $query);
        $result = array();
        while($row = mysqli_fetch_assoc($tmp)) {
            array_push($result, $row);
        }

        return $result;

    }

    public function insertBoardAndImage($info) {

        $this->conn->begin_transaction();

        
        try {

            $boardId = $this->insertBoard($info['board']);

            if(!empty($info['imageList'])) {

                $this->insertImage2($info['imageList'], $boardId);
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