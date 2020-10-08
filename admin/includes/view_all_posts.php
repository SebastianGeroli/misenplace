<?php 
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $post_id){
        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options){
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$post_id}";
                $update_query = mysqli_query($connection,$query);
                confirmQuery($update_query);
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$post_id}";
                $update_query = mysqli_query($connection,$query);
                confirmQuery($update_query);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                $select_post_query = mysqli_query($connection,$query);
                confirmQuery($select_post_query);
                
                $row = mysqli_fetch_assoc($select_post_query);

                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_date = $row['post_date'];
                $post_author = $row['post_author'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];

                $query ="INSERT INTO posts(post_title,post_category_id,post_date,post_author,post_status,post_image,post_tags,post_content) ";
                $query .="VALUES('{$post_title}','{$post_category_id}','{$post_date}','{$post_author}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}')";
                $copy_entry = mysqli_query($connection,$query);
                confirmQuery($copy_entry);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$post_id}";
                $delete_query = mysqli_query($connection,$query);
                confirmQuery($delete_query);
                break;
            default:
                echo "No Action Selected";
                break;

        }



    }
}


?>


<form action="" method="post">

    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="default" selected hidden>Select Action</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New Post</a>
        </div>
        <thead>
            <tr>
                <th><input id="SelectAllBoxes" type="checkbox"></th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Dscripcion</th>
                <th>Imagen</th>
                <th>Fecha Creacion</th>
                <th>Fecha Ultima Modificacion</th>
                <th>Ver Pagina del Producto</th>
                <th>Editar</th>
                <th>Borrar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // FETCH INFO FROM DATRABASE
            $conn = openConnection();
            $query = "SELECT * FROM products ORDER BY prod_id DESC";
            $select_products = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($select_products)){
                $post_id = $row['prod_id'];
                $post_author = $row['prod_name'];
                $post_title = $row['prod_cat'];
                $post_category_id = $row['prod_price'];
                $post_status = $row['prod_description'];
                $post_image = $row['prod_image'];
                $post_tags = $row['prod_creation'];
                $post_comment_count = $row['prod_last_modification'];

                echo "<tr>";
                echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='{$post_id}'></td>";
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>";

                $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                $select_category = mysqli_query($connection,$query);
                confirmQuery($select_category);
                while($row = mysqli_fetch_assoc($select_category)){
                    $category_title = $row['cat_title'];
                }
                echo "<td>{$category_title}</td>";
                echo "<td>{$post_status}</td>";
                echo "<td><img width='100' src='../images/{$post_image}' alt='image'></td>";
                echo "<td>{$post_tags}</td>";
                //GET COMMENT COUNT
                $query = "SELECT COUNT(comment_id) FROM comments WHERE comment_post_id ={$post_id}";
                $comment_count_query = mysqli_query($connection,$query);
                $row = mysqli_fetch_array($comment_count_query);
                $total = $row[0];
                echo "<td>{$total}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a href='../post.php?post_id={$post_id}'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&post_id={$post_id}'>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?') \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>


<?php 
if(isset($_GET['delete'])){
    $delete_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
    $delete_query = mysqli_query($connection,$query);
    confirmQuery($delete_query);
    header("Location: posts.php");
}
?> 