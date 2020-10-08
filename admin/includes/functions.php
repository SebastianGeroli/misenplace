<?php

function openConnection(){
//$db['db_host'] = "localhost";
//$db['db_user'] = "sebastian";
//$db['db_pass'] = "39121285a";
//$db['db_name'] = "cms";

//foreach($db as $key => $value){
//    define(strtoupper($key),$value);
//}
$db_host = "localhost";
$db_user = "sebastian";
$db_pass = "39121285a";
$db_name = "miseenplace";
    
$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
//Debuggin purpose to know if connection is OK
//if($conn){
//    echo "we are connected";  
//}
return $conn;
}
function confirmQuery($result,$conn){
    if(!$result){
        die("QUERY FAILED " . mysqli_error($conn) );
    }
}

function users_online(){
    if(isset($_GET['onlineUsers'])){
        global $connection;
        if(!$connection){
            session_start();
            include("../includes/db.php");
        }
        $session = session_id();
        $time = time();
        $time_out_in_seconds = 300;
        $time_out  = $time - $time_out_in_seconds;
        $query = "SELECT * FROM users_online WHERE session = '{$session}'";
        $send_query = mysqli_query ($connection, $query);
        $count = mysqli_num_rows($send_query);
        if($count == null){
            $query = "INSERT INTO users_online(session,time) VALUES ('{$session}',{$time})";
            $add_user_online = mysqli_query($connection,$query);
        }else{
            $query = "UPDATE users_online SET time = {$time} WHERE session = '{$session}'";
            $update_user_online = mysqli_query($connection,$query);

        }
        $query = "SELECT COUNT(id) FROM users_online WHERE time > {$time_out}";
        $users_online = mysqli_query($connection,$query);
        $count_users = mysqli_fetch_array($users_online)[0];
        echo $count_users;
    }
}

users_online();




function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if( $cat_title== "" || empty($cat_title)){
            echo "This field cant be empty";
        }else{
            $query = "INSERT INTO categories(cat_title) VALUES('{$cat_title}')";
            $create_category_query = mysqli_query($connection,$query);
            if(!$create_category_query){
                die('QUERY FAILED'. mysqli_error($create_category_query));
            }
        }
    }
}

function find_show_all_categories(){
    global $connection;
    //Select Categories
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "</tr>";
    }

}
function delete_category(){
    global $connection;
    //Delete Query
    if(isset($_GET['delete'])){
        $cat_id_to_delete = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$cat_id_to_delete}";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php");
    }
}