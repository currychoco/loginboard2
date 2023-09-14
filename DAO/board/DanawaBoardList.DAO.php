<?php

class DanawaBoardList {

    private $conn;

    //생성자 - DB 커넥션 연결
    public function __construct(){
        $this->conn = mysqli_connect("localhost", "root", "password", "mysql");
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

}