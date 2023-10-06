<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
require_once DAO_PATH . '/Common.DAO.php';
class DanawaBoardList extends common\CommonDAO {

    //생성자 - DB 커넥션 연결
    public function __construct(){
        parent::__construct();
    }

    // 쿼리로 조회된 결과물 배열로 반환
    public function getBoardList($no = 0, $pageSize = PAGE_SIZE, $search='', $keyword='') {

        $stmt = null;

        if(empty($keyword) && strlen($keyword) < 1) {

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
                GROUP BY b.id
                ORDER BY id DESC
                LIMIT ?, ?
            ");

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $no, $pageSize);
            $stmt->execute();
        }
        else if($search == 'title') { 

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
                WHERE title like CONCAT('%', ?, '%')
                GROUP BY b.id
                ORDER BY id DESC
                LIMIT ?, ?
            ");

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sii", $keyword, $no, $pageSize);
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
                WHERE u.user_id like CONCAT('%', ?, '%')
                GROUP BY b.id
                ORDER BY id DESC
                LIMIT ?, ?
            ");

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sii", $keyword, $no, $pageSize);
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
    public function getBoardListCount($search = '', $keyword = ''){

        $result = null;
        if(empty($keyword) && strlen($keyword) < 1) {

            $query = "SELECT COUNT(*) AS count FROM login_board";
            $result = mysqli_query($this->conn, $query);

        }
        else if($search == 'title') {

            $query = "SELECT COUNT(*) AS count FROM login_board WHERE title LIKE CONCAT('%', ?, '%')";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('s', $keyword);
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
            ");

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('s', $keyword);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        $row = mysqli_fetch_array($result);

        return $row['count'];

    }

    // 게시글 생성
    public function insertBoard($title, $content, $userNo) {

        $stmt = $this->conn->prepare("
            INSERT INTO login_board (
                title,
                content,
                user_no
            ) 
            VALUES (
                ?, ?, ?
            )
        ");

        $stmt->bind_param('sss', $title, $content, $userNo);
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
                b.view_count
            FROM login_board b
                INNER JOIN board_user u ON b.user_no = u.no
            WHERE id = ?
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
    
}