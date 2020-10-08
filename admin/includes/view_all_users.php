<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <th>Make Admin</th>
            <th>Make Normal</th>
            <th>Edit User</th>
            <th>DANGER ZONE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $select_comments = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_comments)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_image}</td>";
            echo "<td>{$user_role}</td>";
            echo "<td><a href='users.php?make_admin={$user_id}'>Make Admin</a></td>";
            echo "<td><a href='users.php?make_normal={$user_id}'>Make Normal</a></td>";
            echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
            echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>


<?php 
if(isset($_GET['make_admin'])){
    $user_id = $_GET['make_admin'];
    $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$user_id} ";
    $approve_query = mysqli_query($connection,$query);
    confirmQuery($approve_query);
    header("Location: users.php");
}


if(isset($_GET['make_normal'])){
    $user_id = $_GET['make_normal'];
    $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = {$user_id} ";
    $approve_query = mysqli_query($connection,$query);
    confirmQuery($approve_query);
    header("Location: users.php");
}


if(isset($_GET['delete'])){
    if(isset($_SESSION['user_role'])){
        if(strtolower($_SESSION['user_role']) == 'admin'){
            $user_id = mysqli_real_escape_string($connection,$_GET['delete']);
            $query = "DELETE FROM users WHERE user_id = {$user_id}";
            $delete_query = mysqli_query($connection,$query);
            confirmQuery($delete_query);
            header("Location: users.php");
        }
    }
}


?> 