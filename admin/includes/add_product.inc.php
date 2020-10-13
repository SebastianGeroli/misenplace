<?php 
if(isset($_POST['create_product'])){
    //Content
    $prod_title = $_POST['prod_title'];
    $prod_category = $_POST['prod_category'];
    $prod_price = $_POST['prod_price'];
    $prod_description = $_POST['prod_description'];

    //Image
    $prod_image = $_FILES['image']['name'];
    $prod_image_temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($prod_image_temp,"../img/$prod_image");

    $productController = new ProductController();
    $LastId = $productController->AddProductToDB($prod_title,$prod_category,$prod_price,$prod_description,$prod_image);
    echo "<p class='bg-success'>Producto Añadido: <a href='products.php'>Ver todos los productos</a> O <a href='../product.php?prod_id={$LastId}'>Ver pagina del producto</a> </p>";
}


?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="prod_title">Nombre(Titulo)</label>
        <input type="text" class="form-control" name="prod_title">
    </div>
    <div class="form-group">
        <label for="prod_category">Categoria del Producto</label>
        <select name="prod_category" id="prod_category">
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
        <label for="prod_price">Precio</label>
        <input type="text" class="form-control" name="prod_price">
    </div>
    <div class="form-group">
        <label for="prod_description">Descripcion</label>
        <textarea  class="form-control" name="prod_description" id="editor" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Imagen</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_product" value="Agregar Producto">
    </div>

</form>