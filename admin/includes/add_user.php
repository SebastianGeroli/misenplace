<?php 
    if(isset($_POST['create_user'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $user_role = $_POST['user_role'];
        
        //$user_image = $_FILES['image']['name'];
        //$user_image_temp = $_FILES['image']['tmp_name'];
        
        
        //move_uploaded_file($post_image_temp,"../images/$post_image");
        $password = password_hash($password,PASSWORD_BCRYPT,array('cost'=> 10));
        
        $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role) ";
        $query .= "VALUES('{$username}','{$password}','{$first_name}','{$last_name}','{$email}', '{$user_role}')";
        
        $create_post_query = mysqli_query($connection,$query);
       
        confirmQuery($create_post_query);
        
        echo "User Created: <a href='users.php'>View All Users</a>";
        
    }


?>
   

   
   
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="user_role">
            <option value="Subscriber" selected>Subscriber</option>
            <option value="Admin">Admin</option>

        </select>
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name">
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="last_name">
    </div>
     <div class="form-group">
        <label for="email">Email</label>
        <input type="emial" class="form-control" name="email">
    </div>
<!--
     <div class="form-group">
        <label for="image">Profile Image</label>
        <input type="file" name="image">
    </div>
-->
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
    </div>

</form>