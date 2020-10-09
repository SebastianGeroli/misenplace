<?php
class Users extends Dbh
{

    //GET ONE USER
    /**
     * Get a user based on ID
     * @param integer $userID
     * @return assocArray with all the info of the user
     */
    protected function getUser($userID)
    {
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$userID]);
        $result = $stmt->fetch();
        return $result;
    }
    //GET ALL USERS
    protected function GetAllUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    //GET USERS WITH FILTER 1
    /**
     * Retrive all info from users with 1 column filter
     * @param string $column filter on this column
     * @param string $cValue filter column with this value
     */
    protected function GetAllUsersWith($column, $cValue)
    {
        $sql = "SELECT * FROM users WHERE $column = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$cValue]);
        $result = $stmt->fetchAll();
        return $result;
    }
    //INSERT USER
    /**
     * Insert a new user with email and password
     * @param string $email
     * @param string $password
     * @param string optional param to add a First Name
     * @param string optional param to add a Last Name
     * @param integer optional param to add a Different Role
     */
    protected function InsertNewUser($email, $password, $firstname = "", $lastname = "", $role = 4)
    {
        $sql = "INSERT INTO users(user_email,user_password,user_first_name,user_last_name,user_role_id) VALUES(?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $password, $firstname, $lastname, $role]);
    }

    //UPDATE USER
    /**
     * Update a user information
     * 
     * if password is empty or blank = "" will not be updated 
     * @param string $email
     * @param string $password
     * @param string $firstname
     * @param string $lastname
     * @param integer $role
     * @param integer $userID
     */
    protected function UpdateUser($email, $password, $firstname, $lastname, $role, $userID)
    {
        if (empty($password) || $password == "") {
            $sql = "UPDATE users SET 
            user_email = :email,
            user_fist_name = :first_name, 
            user_last_name = :last_name,
            user_role = :u_role 
            WHERE user_id = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['email' => $email, 'first_name' => $firstname, 'last_name' => $lastname, 'u_role' => $role, 'id' => $userID]);
        } else {
            $sql = "UPDATE users SET 
            user_email = :email, 
            user_password = :pass, 
            user_fist_name = :first_name, 
            user_last_name = :last_name,
            user_role = :u_role 
            WHERE user_id = :id";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute(['email' => $email, 'pass' => $password, 'first_name' => $firstname, 'last_name' => $lastname, 'u_role' => $role, 'id' => $userID]);
        }
    }
}
