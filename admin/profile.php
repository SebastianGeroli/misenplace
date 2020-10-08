<?php include "includes/admin_header.php"; ?>

<?php if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    $select_user_profile = mysqli_query($connection,$query);

    if(!$select_user_profile){
        die("QUERY FAILED " . mysqli_error($connection) );
    }

    $row = mysqli_fetch_assoc($select_user_profile);

    $username = $row['username'];
    $password = $row['user_password'];
    $first_name = $row['user_firstname'];
    $last_name = $row['user_lastname'];
    $email = $row['user_email'];
    
    
if(isset($_POST['update_profile'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    if(empty($password)){
        $password = $row['user_password'];
    }else{
        $password = password_hash($password,PASSWORD_BCRYPT,array('cost'=> 10));
    }

    $query = "UPDATE users SET username = '{$username}',user_password = '{$password}',user_firstname = '{$first_name}',user_lastname = '{$last_name}',user_email = '{$email}' WHERE user_id = {$user_id}";

    $update_profile_query = mysqli_query($connection,$query);

    if(!$update_profile_query){
        die("QUERY FAILED " . mysqli_error($connection));
    }

}

} 


?>
<!-- Navigation -->
<?php include "includes/admin_navigation.php";?>

<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class='page-header'>Your Profile</h1>
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
                        <label for="image">Your Profile Image</label>
                        <img width="200" src="../images/<?php echo $user_image; ?>" alt="">
                    </div>
                    <div class="form-group">
                        <label for="image">Choose new Image</label>
                        <input type="file" name="image">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php"; ?>