<?php

class UsersView extends Users{
    public function showUser($userID){
        $result = $this->getUser($userID);
        echo "Name: " . $result['user_first_name'] . "Last Name" . $result['user_last_name'] ;
    }
}