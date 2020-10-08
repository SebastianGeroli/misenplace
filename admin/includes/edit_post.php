
<?php 
if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
    $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
    $select_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_query)){
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_author = $row['post_author'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
    }

}
if(isset($_POST['update_post'])){
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    move_uploaded_file($post_image_temp, "../images//$post_image");
    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $select_image = mysqli_query($connection,$query);
        confirmQuery($select_image);
        while($row = mysqli_fetch_assoc($select_image)){
            $post_image = $row['post_image'];
        }
    }
    $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_category_id}', post_date = now(), post_author = '{$post_author}',post_status = '{$post_status}',post_tags = '{$post_tags}',post_content = '{$post_content}',post_image = '{$post_image}' WHERE post_id = {$post_id}";
    $update_post_query = mysqli_query($connection,$query);
    confirmQuery($update_post_query);
    
    echo "<p class='bg-success'>Post Updated: <a href='posts.php'>Edit More Posts</a> OR <a href='../post.php?post_id={$post_id}'>View This Post</a> </p>";
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category ID</label>
        <select name="post_category" id="post_category">
            <?php 
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection,$query);
            confirmQuery($select_categories);
            while($row = mysqli_fetch_assoc($select_categories)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
    <label for="post_status">Post Status</label>
    <select name="post_status" id="">
        <option value="<?php echo strtolower($post_status); ?>"><?php echo ucfirst($post_status); ?></option>
        <?php 
            if(strtolower($post_status) == "draft"){
                echo "<option value='published'>Published</option>";
            }else{
                 echo "<option value='draft'>Draft</option>";
            }
        ?>
    </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <img width="200" src="../images/<?php echo $post_image; ?>" alt="">
    </div>
    <div class="form-group">
        <label for="image">Choose new Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea  class="form-control" name="post_content" id="" cols="30" rows="10" ><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
    </div>
</form>