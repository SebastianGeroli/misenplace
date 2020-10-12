<?php
if (isset($_GET['product_id'])) {
    $prod_ID = $_GET['product_id'];
    $productView = new ProductView();
    $result = $productView->GetProductByID($prod_ID);


    $prod_name = $result['prod_name'];
    $prod_cat = $result['prod_cat'];
    $prod_price = $result['prod_price'];
    $prod_description = $result['prod_description'];
    $prod_image = $result['prod_image'];
}
if (isset($_POST['update_product'])) {

    //Data
    $prod_name = $_POST['prod_name'];
    $prod_category = $_POST['prod_category'];
    $prod_price = $_POST['prod_price'];
    $prod_description = $_POST['prod_description'];

    //Image
    $prod_image = $_FILES['image']['name'];
    $prod_image_temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($prod_image_temp,"../img/$prod_image");

    if (empty($prod_image)) {
        $productView = new ProductView();
        $result = $productView->getValueByColumnAndID("prod_image", $prod_ID);
        $prod_image = $result['prod_image'];
    }
    $productController = new ProductController();
    $productController->UpdateProductByID($prod_name,$prod_cat,$prod_price,$prod_description,$prod_image,$prod_ID);
    echo "<p class='bg-success'>Producto Editado Correctamente: <a href='products.php'>Editar mas productos</a> OR <a href='../product.php?post_id={$prod_ID}'>Ver pagina del producto</a> </p>";
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="prod_name">Nombre del producto(Titulo)</label>
        <input type="text" class="form-control" name="prod_name" value="<?php echo $prod_name; ?>">
    </div>
    <div class="form-group">
        <label for="prod_category">Categoria del prodcuto</label>
        <select name="prod_category" id="prod_category">
            <?php
            $categoryView = new CategoryView();
            $result = $categoryView->GetAll();
            foreach ($result as $row) {
                $cat_id = $row['cat_id'];
                $cat_name = $row['cat_name'];
                echo "<option value='{$cat_id}'>{$cat_name}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="prod_price">Precio</label>
        <input type="text" class="form-control" name="prod_price" value="<?php echo $prod_price; ?>">
    </div>
    <!-- <div class="form-group">
    <label for="post_status">Post Status</label>
    <select name="post_status" id="">
        <option value="<?php echo strtolower($post_status); ?>"><?php echo ucfirst($post_status); ?></option>
        <?php
        if (strtolower($post_status) == "draft") {
            echo "<option value='published'>Published</option>";
        } else {
            echo "<option value='draft'>Draft</option>";
        }
        ?>
    </select>
    </div> -->

    <div class="form-group">
        <label for="image">Imagen del producto</label>
        <img width="200" src="../img/<?php echo $prod_image; ?>" alt="">
    </div>
    <div class="form-group">
        <label for="image">Choose new Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="prod_description">Descripcion del producto</label>
        <textarea class="form-control" name="prod_description" id="editor" cols="30" rows="10"><?php echo $prod_description; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_product" value="Editar Producto">
    </div>
</form>