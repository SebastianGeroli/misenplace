                    <form action="" method="post">
                        <?php 
                        if(isset($_GET['edit'])):
                        $cat_id =$_GET['edit'];
                        $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
                        $select_category = mysqli_query($connection,$query);
                        if(!$select_category){
                            echo "QUERY FAILED". mysqli_error($select_category);                           
                        }else{
                            $row = mysqli_fetch_assoc($select_category);
                            $cat_title = $row['cat_title'];
                        }
                        if(isset($_POST['update_category'])){
                            $cat_title = $_POST['new_title'];
                            $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id}";
                            $update_query = mysqli_query($connection,$query);
                            if(!$update_query){
                                die("QUERY FAILED" . mysqli_error($update_query));
                            }
                        }
                        ?>
                        <label for="cat_title">Update Category</label>
                        <div class="form-group">
                            <input class="form-control" type="text" name="new_title" placeholder="Category Title" value="<?php echo $cat_title ?>">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_category" value="update">
                        </div>
                        <?php endif;  ?>
                    </form>