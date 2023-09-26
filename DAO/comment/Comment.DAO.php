<?php

include DAO_PATH . '/Common.DAO.php';
class Comment extends CommonDAO {

    public function __construct() {
        parent::__construct();
    }

    // 댓글 작성
    public function createComment($comment) {
        
        $query = ("
            INSERT INTO comment (
                board_id,
                user_no,
                parent_id,
                comment
            ) 
            values (
                ?, ?, ?, ?
            )
        ");

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('iiis', $comment['boardId'], $comment['userNo'], $comment['parentId'], $comment['comment']);
        
        return $stmt->execute();

    }

    // 댓글 리스트
    public function getCommentList($boardId) {

        $query = ("
            SELECT
                c.id,
                c.board_id,
                u.user_id,
                c.parent_id,
                c.comment,
                c.reg_date,
                c.mod_date
            FROM comment c
            INNER JOIN board_user u
            ON c.user_no = u.no
            WHERE board_id = ?
            ORDER BY id DESC;
        ");
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $boardId);

        $stmt->execute();

        $result = $stmt->get_result();

        $listResult = array();
        while($row = mysqli_fetch_array($result)) {

            array_push($listResult, $row);

        }

        return $listResult;
    }
}