<?php 
if(isset($_POST['create_post'])){
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    move_uploaded_file($post_image_temp,"../images/$post_image");

    $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image,post_content,post_tags,post_status) ";
    $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

    $create_post_query = mysqli_query($connection,$query);

    confirmQuery($create_post_query);
    
    $post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post Added: <a href='posts.php'>View All Posts</a> OR <a href='../post.php?post_id={$post_id}'>View This Post</a> </p>";
}


?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Nombre(Titulo)</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_category">Categoria del Producto</label>
        <select name="post_category" id="post_category">
            <?php 
            //Get categories
            $categoryView = new CategoryView();
            $result = $categoryView->GetAll();
            foreach($result as $row){
                $cat_id = $row['cat_id'];
                $cat_name = $row['cat_name'];
                echo "<option value='{$cat_id}'>{$cat_name}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Precio</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="author">Descripcion</label>
        <textarea  class="form-control" name="post_content" id="editor" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Imagen</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Agregar Producto">
    </div>

</form>