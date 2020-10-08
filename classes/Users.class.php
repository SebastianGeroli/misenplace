<?php 
class Users extends Dbh{

    protected function getUser($userID){
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID]);
        $result = $stmt->fetch();
        return $result;
    }
    protected function setUser($userID){
        $sql = "INSERT INTO users()";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID]);
    }
}