
<?php 
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    $select_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_query)){
        $username = $row['username'];
        $password = $row['user_password'];
        $first_name = $row['user_firstname'];
        $last_name = $row['user_lastname'];
        $email = $row['user_email'];
        $user_role = $row['user_role'];
    }

    if(isset($_POST['update_user'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $user_role = $_POST['user_role'];

        //    $post_image = $_FILES['image']['name'];
        //    $post_image_temp = $_FILES['image']['tmp_name'];

        // move_uploaded_file($post_image_temp, "../images//$post_image");

        //    if(empty($post_image)){
        //        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        //        $select_image = mysqli_query($connection,$query);
        //        confirmQuery($select_image);
        //        while($row = mysqli_fetch_assoc($select_image)){
        //            $post_image = $row['post_image'];
        //        }
        //    }

        if(empty($password)){
            $query = $row['user_password'];
        }else{
         $password = password_hash($password,PASSWORD_BCRYPT,array('cost'=> 10));
        }

        $query = "UPDATE users SET username = '{$username}', user_password = '{$password}', user_firstname = '{$first_name}', user_lastname = '{$last_name}',user_email = '{$email}',user_role = '{$user_role}' WHERE user_id = {$user_id}";
        $update_user_query = mysqli_query($connection,$query);
        confirmQuery($update_user_query);
    }
}else{
    header("Location: index.php");
}

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="user_role">
            <?php 
            $query = "SELECT user_role FROM users WHERE user_id='{$user_id}'";
            $select_categories = mysqli_query($connection,$query);
            confirmQuery($select_categories);
            while($row = mysqli_fetch_assoc($select_categories)){
                $user_role = $row['user_role'];
                if($user_role == 'Admin'){
                    echo "<option value='Admin' selected>{$user_role}</option>";
                    echo "<option value='Subscriber'>Subscriber</option>";
                }else{
                    echo "<option value='Subscriber' selected>{$user_role}</option>";
                    echo "<option value='Admin'>Admin</option>"; 
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>">
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
    </div>

    <div class="form-group">
        <label for="image">User Image</label>
        <img width="200" src="../images/<?php echo $user_image; ?>" alt="">
    </div>
    <div class="form-group">
        <label for="image">Choose new Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_user" value="Edit User">
    </div>
</form>