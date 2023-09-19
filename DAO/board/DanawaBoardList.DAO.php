<?php
include DAO_PATH . '/Common.DAO.php';
class DanawaBoardList extends CommonDAO {

    //생성자 - DB 커넥션 연결
    public function __construct(){
        parent::__construct();
    }

    // 쿼리로 조회된 결과물 배열로 반환
    public function getBoardList($no = 0, $pageSize = PAGE_SIZE) {

        $query = ("
            select 
                b.id,
                b.title,
                b.content,
                u.user_id,
                b.reg_date,
                b.view_count
            from login_board b
            inner join board_user u
            on b.user_no = u.no
            order by id desc
            limit ?, ?
        ");

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $no, $pageSize);

        $stmt->execute();
        $result = $stmt->get_result();

        $listResult = array();
        while($row = mysqli_fetch_array($result)) {

            array_push($listResult, $row);

        }

        return $listResult;

    }

    // 총 게시글 개수 반환
    public function getBoardListCount(){

        $query ="select count(*) as count from login_board;";
        $result = mysqli_query($this->conn, $query);
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
}