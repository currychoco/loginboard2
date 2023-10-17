<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/loginboard2/conf.php';
require_once DAO_PATH . '/Common.DAO.php';
class User extends common\CommonDAO {

    public function __construct(){
       parent::__construct();
    }

    public function setUser($user){

        $query = ("
        insert into board_user(
            name,
            user_id,
            password,
            gender,
            phone_number
        ) values (
            ?, ?, ?, ?, ?
        )
        ");

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $user['name'], $user['userId'], $user['pw'], $user['gender'], $user['phoneNumber']);

        if($stmt->execute()) {
            return true;
        }
        else {
            return false;
        }  

    }

    public function getUserIdAndPw($id, $pw){

        $query = "SELECT no, user_id, password, admin FROM board_user WHERE user_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $id);

        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_array($result);

        return $row;
    }


    public function getUser($no, $id){

        $query = 'select user_id, name, gender, phone_number, reg_date from board_user where no = ? and user_id = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('is', $no, $id);

        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_array($result);

        return $row;
    }


    public function deleteUser($no, $id){
        $query = 'delete from board_user where no = ? and user_id = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('is', $no, $id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function updateUser($user){
        $query = ("
            update board_user set
                name = ?, 
                phone_number = ?,
                gender = ?
            where no = ? and user_id = ?
        ");

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sssis', $user['name'], $user['phoneNumber'], $user['gender'], $user['no'], $user['userId']);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function idCheck($userId){

        $query = "select count(*) as count from board_user where user_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $userId);

        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_array($result);

        return $row['count'];
    }
}   